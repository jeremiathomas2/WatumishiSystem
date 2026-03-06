import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Generate offline assets manifest
function generateOfflineAssets() {
    const buildDir = path.join(__dirname, '../public/build');
    const manifest = {
        version: Date.now(),
        assets: []
    };

    if (fs.existsSync(buildDir)) {
        const files = fs.readdirSync(buildDir, { recursive: true });
        files.forEach(file => {
            const filePath = path.join(buildDir, file);
            if (fs.statSync(filePath).isFile()) {
                manifest.assets.push({
                    url: `/build/${file}`,
                    revision: Date.now()
                });
            }
        });
    }

    fs.writeFileSync(
        path.join(__dirname, '../public/offline-manifest.json'),
        JSON.stringify(manifest, null, 2)
    );

    console.log('✅ Offline assets manifest generated');
}

generateOfflineAssets();

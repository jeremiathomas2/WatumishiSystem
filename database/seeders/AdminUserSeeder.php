<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default company
        $company = Company::create([
            'name' => 'Watumishi HR Solutions',
            'registration_number' => 'REG202400001',
            'tax_identification_number' => 'TIN202400001',
            'sector' => 'services',
            'address' => 'Dar es Salaam, Tanzania',
            'phone' => '+255 123 456 789',
            'email' => 'info@watumishi.com',
            'union_status' => 'non_unionized',
            'is_active' => true,
        ]);

        // Create admin user
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@watumishi.com',
            'password' => Hash::make('admin@123'),
            'role' => 'super_admin',
            'company_id' => $company->id,
            'is_active' => true,
            'permissions' => [
                'manage_companies',
                'manage_employees',
                'manage_payroll',
                'manage_attendance',
                'manage_discipline',
                'manage_leave',
                'manage_reports',
                'manage_system',
            ],
        ]);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'hr_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'employee_id',
        'role',
        'is_active',
        'last_login_at',
        'last_login_ip',
        'permissions',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isHrAdmin()
    {
        return $this->role === 'hr_admin';
    }

    public function isHrOfficer()
    {
        return $this->role === 'hr_officer';
    }

    public function isFinanceOfficer()
    {
        return $this->role === 'finance_officer';
    }

    public function isLineManager()
    {
        return $this->role === 'line_manager';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function isExternalAuditor()
    {
        return $this->role === 'external_auditor';
    }
}

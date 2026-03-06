<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'registration_number',
        'tax_identification_number',
        'sector',
        'address',
        'phone',
        'email',
        'union_status',
        'union_name',
        'collective_agreement',
        'is_active',
    ];

    protected $casts = [
        'collective_agreement' => 'array',
        'is_active' => 'boolean',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

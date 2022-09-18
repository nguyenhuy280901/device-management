<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Get the employees that working in the department.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}

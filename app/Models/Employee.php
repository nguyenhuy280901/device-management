<?php

namespace App\Models;

use App\Enumerations\EmployeeRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'image',
        'email',
        'password',
        'department_id',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    /**
     * Get the department that the employee belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Get the bookings that onws the employee.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'employee_id');
    }

    /**
     * Get the employee's role
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function role(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return EmployeeRole::from($value);
            },
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    /**
     * Get the employee that create the backup
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

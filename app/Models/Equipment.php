<?php

namespace App\Models;

use App\Enumerations\EquipmentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = "equipments";
    public $timestamps = false;

    /**
     * Get the equipment's status
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return EquipmentStatus::from($value);
            },
        );
    }
}

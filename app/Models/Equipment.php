<?php

namespace App\Models;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = "equipments";
    public $timestamps = false;
    protected $fillable = [
        'name', 'image', 'description', 'status', 'approve_level', 'category_id'
    ];

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
            set: function(EquipmentStatus|string $status) {
                if($status instanceof EquipmentStatus)
                {
                    return $status->value;
                }
                return $status;
            }
        );
    }

    /**
     * Get the equipment's approve level
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function ApproveLevel(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return ApproveLevel::from($value);
            },
        );
    }

    /**
     * Get the category that the equipment belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

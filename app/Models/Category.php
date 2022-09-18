<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Get the equipments that onws the category.
     */
    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }
}

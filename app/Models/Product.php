<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;

    // Define the fields that can be mass assigned
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
        // Add all other fields that you expect to be filled via forms
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
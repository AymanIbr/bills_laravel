<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table = 'categories';

    protected $fillable = [
        'sections_name', 'description', 'created_by'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'category_id', 'id');
    }
}

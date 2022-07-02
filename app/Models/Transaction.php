<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'category_id',
        'name',
        'nominal',
        'description',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

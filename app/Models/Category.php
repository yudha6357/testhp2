<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;


class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'logging_type',
        'name',
        'description',
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'category_id', 'id');
    }

   
}

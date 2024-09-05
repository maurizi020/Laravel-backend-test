<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Divisa;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'tax',
        'price'
    ];
    public function divisa()
    {
        return $this->belongsTo(Divisa::class, 'divisa_id');
    }
}

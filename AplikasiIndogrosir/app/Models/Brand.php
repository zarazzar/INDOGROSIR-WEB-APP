<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'brand';

    protected $fillable = [
        'nama_brand',
        'logo_brand'
    ];

    public function produk() {
        return $this->hasMany(Produk::class);
    }
}

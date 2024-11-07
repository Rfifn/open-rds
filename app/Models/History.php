<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = [
        'product_id', 'merk', 'seri', 'keterangan', 'tipe'
    ];
    public function product()
{
    return $this->belongsTo(Product::class);
}

}

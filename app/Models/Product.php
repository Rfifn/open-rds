<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'merk',
        'spek',
        'lokasi',
        'seri',
        'date_out',
        'keterangan',
        'flg_item_out',
        'status', // Pastikan 'update' dihapus
    ];
    
    // Relasi ke model Histori
    public function history()
    {
        return $this->hasMany(History::class);
    }
}

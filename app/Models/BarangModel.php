<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $guarded = ['id'];
    protected $casts = ['id' => 'string'];

    public function manifest() : BelongsTo 
    {
        return $this->belongsTo(ManifestModel::class, 'id_barang', 'id');
    }
}

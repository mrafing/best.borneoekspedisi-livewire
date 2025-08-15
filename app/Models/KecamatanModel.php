<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KecamatanModel extends Model
{
    protected $table = 'tb_kecamatan';
    protected $casts = ['id' => 'string'];

    public function kota() : BelongsTo 
    {
        return $this->belongsTo(KotaModel::class, 'id_kota', 'id');
    }

    public function pengirim() : HasMany 
    {
        return $this->hasMany(PengirimModel::class, 'id_kecamatan_pengirim', 'id');
    }

    public function penerima() : HasMany 
    {
        return $this->hasMany(PenerimaModel::class, 'id_kecamatan_penerima', 'id');
    }
}

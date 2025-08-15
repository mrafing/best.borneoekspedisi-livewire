<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KotaModel extends Model
{
    protected $table = 'tb_kota';
    protected $cast = ['id' => 'string'];

    public function kecamatan() : HasMany 
    {
        return $this->hasMany(KecamatanModel::class, 'id_kota', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LayananModel extends Model
{
    protected $table = 'tb_layanan';
    protected $casts = ['id' => 'string'];

    public function manifest() : HasMany 
    {
        return $this->hasMany(ManifestModel::class, 'id_layanan', 'id');
    }
}

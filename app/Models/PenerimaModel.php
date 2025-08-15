<?php

namespace App\Models;

use App\Models\ManifestModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenerimaModel extends Model
{
    protected $table = 'tb_penerima';
    protected $guarded = ['id'];
    protected $casts = ['id' => 'string'];

    public function manifests() : HasMany 
    {
        return $this->hasMany(ManifestModel::class, 'id_penerima', 'id');
    }

    public function kecamatan() : BelongsTo 
    {
        return $this->belongsTo(KecamatanModel::class, 'id_kecamatan_penerima', 'id');
    }
}

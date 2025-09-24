<?php

namespace App\Models;

use App\Models\PengirimModel;
use App\Traits\Mutator\GenUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManifestModel extends Model
{
    use GenUid;

    protected $table = 'tb_manifest';
    protected $guarded = ['id'];
    // protected $with = ['pengirim', 'penerima', 'barang', 'ongkir'];

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(PengirimModel::class, 'id_pengirim', 'id');
    }

    public function penerima(): BelongsTo
    {
        return $this->belongsTo(PenerimaModel::class, 'id_penerima', 'id');
    }

    public function barang() : BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id');
    }

    public function ongkir() : BelongsTo
    {
        return $this->belongsTo(OngkirModel::class, 'id_ongkir', 'id');
    }

    public function layanan() : BelongsTo
    {
        return $this->belongsTo(LayananModel::class, 'id_layanan', 'id');
    }
}

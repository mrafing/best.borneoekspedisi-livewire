<?php

namespace App\Models;

use App\Models\ManifestModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengirimModel extends Model
{
    protected $table = 'tb_pengirim';
    protected $guarded = ['id'];
    protected $casts = ['id' => 'string'];

    public function manifests() : HasMany
    {
        return $this->hasMany(ManifestModel::class, 'id_pengirim', 'id');
    }
}

<?php

namespace App\Models;

use App\Traits\Mutator\GenUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OngkirModel extends Model
{
    use GenUid;
    
    protected $table = 'tb_ongkir';
    protected $guarded = ['id'];
    protected $casts = ['id' => 'string'];

    public function manifest() : BelongsTo
    {
        return $this->belongsTo(ManifestModel::class, 'id_ongkir', 'id');
    }
}

<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class OpnameAset extends Model
{
    use Uuid;
    protected $guarded = [];

    public function Aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'id');
    }
}

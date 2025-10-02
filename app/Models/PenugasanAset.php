<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class PenugasanAset extends Model
{
    use Uuid;
    protected $guarded = [];

    public function Penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'penugasan_id', 'id');
    }
    public function Aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'id');
    }
}

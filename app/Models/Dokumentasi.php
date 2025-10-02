<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use Uuid;
    protected $guarded = [];

    public function Penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'penugasan_id', 'id');
    }
}

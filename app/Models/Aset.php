<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use Uuid;
    protected $guarded = [];

    public function PenugasanAset()
    {
        return $this->hasMany(PenugasanAset::class, 'aset_id', 'id');
    }
    public function PengembalianAset()
    {
        return $this->hasMany(Aset::class, 'aset_id', 'id');
    }
    public function OpnameAset()
    {
        return $this->hasMany(OpnameAset::class, 'aset_id', 'id');
    }
}

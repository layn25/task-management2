<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use Uuid;
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function PenugasanAset()
    {
        return $this->hasMany(PenugasanAset::class, 'penugasan_id', 'id');
    }
    public function ApprovalPetugas()
    {
        return $this->hasMany(ApprovalPetugas::class, 'penugasan_id', 'id');
    }
    public function Dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'penugasan_id', 'id');
    }
}

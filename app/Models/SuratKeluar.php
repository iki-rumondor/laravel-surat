<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $guarded = [
        'id'
    ];

    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}

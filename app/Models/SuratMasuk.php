<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $guarded = ['id'];

    protected $dates = [
        'tanggal_terima'
    ];

    public function surat(){
        return $this->hasOne(Disposisi::class);
    }

}

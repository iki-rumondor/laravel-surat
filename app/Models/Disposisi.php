<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;

class Disposisi extends Model
{
    protected $table = "disposisi";
    protected $guarded = ['id'];

    public function surat_masuk(){
        return $this->belongsTo(SuratMasuk::class);
    }
}

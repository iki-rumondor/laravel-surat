<?php

namespace App\Http\Controllers;
use App\Models\Disposisi;
use App\Models\SuratMasuk;

class FetchController extends Controller
{
    public function get_surat_masuk($id){
        $data = SuratMasuk::find($id);
        return response()->json($data);
    }
}

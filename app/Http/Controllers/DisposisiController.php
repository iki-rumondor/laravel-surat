<?php
namespace App\Http\Controllers;

use App\Http\Requests\DisposisiRequest;
use App\Models\Disposisi;
use App\Models\SuratMasuk;

class DisposisiController extends Controller
{
    public function index()
    {
        $disposisi = Disposisi::with('surat')->get();
        return view('disposisi.index', compact('disposisi'));
    }

    public function store(DisposisiRequest $request)
    {
        $data = [
            "surat_id" => $request->surat_id,
            "sifat" => $request->sifat,
            "kepada" => $request->kepada,
            "tindakan" => $request->tindakan,
            "catatan" => $request->catatan,
        ];

        Disposisi::create($data);
        SuratMasuk::where('id', $request->surat_id)->update(['status' => 'Disposisi']);

        return redirect('/surat-masuk')->with([
            'status' => 'success',
            'notification' => 'Data berhasil disimpan!'
        ]);
    }
}

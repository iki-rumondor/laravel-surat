<?php
namespace App\Http\Controllers;

use App\Http\Requests\DisposisiRequest;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    public function index()
    {
        $disposisi = Disposisi::with('surat_masuk')->where("kepada", Auth::guard('pengguna')->User()->role)->get();
        return view('disposisi.index', compact('disposisi'));
    }

    public function store(DisposisiRequest $request)
    {
        $data = [
            "surat_masuk_id" => $request->surat_id,
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

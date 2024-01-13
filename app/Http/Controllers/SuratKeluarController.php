<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use Storage;
use Auth;
use DB;
use Carbon\Carbon;

use App\Models\Unit;
use App\Models\Kategori;
use App\Models\SuratKeluar;

use Illuminate\Http\Request;
use App\Services\LampiranFileService;
use App\Http\Requests\SuratKeluarRequest;


class SuratKeluarController extends Controller
{

    protected $lampiranFileServe;

    public function __construct(LampiranFileService $lampiranFileService)
    {
        $this->lampiranFileServe = $lampiranFileService;
    }

    public function index()
    {
        $suratKeluar = SuratKeluar::paginate(5);

        return view('surat_keluar.surat_keluar', compact('suratKeluar'));
    }

    public function create()
    {

        return view('surat_keluar.form_create');
    }

    public function store(SuratKeluarRequest $request)
    {
        $data = [
            'kategori' => $request->kategori,
            'unit' => $request->unit,
            'jenis' => $request->jenis,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_keluar' => $request->tanggal_keluar,
            'perihal' => $request->perihal,
            'ttd' => $request->ttd,
        ];

        if ($request->lampiran != null){
            $lampiranFile = $request->lampiran;
            $lampiranFileName = 'dokumen_' . date('YmdHis');
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();
            $lampiranFileName = $lampiranFileName . '.' . $lampiranFileExtension;

            $data["lampiran"] = $lampiranFileName;
            $this->lampiranFileServe
                ->uploadLampiranFile($lampiranFile, $lampiranFileName);
        }

        SuratKeluar::create($data);

        return redirect('/surat-keluar')
            ->with([
                'notification' => 'Data berhasil disimpan!'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $checkSuratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar = $checkSuratKeluar;
        $unit = Unit::all();

        return view('surat_keluar.form_edit', compact('suratKeluar', 'Unit'));
    }

    public function update(SuratKeluarRequest $suratKeluarRequest, $id)
    {
        # set variable
        $nomor = $suratKeluarRequest->nomor;
        $tujuan = $suratKeluarRequest->tujuan;
        $unitID = $suratKeluarRequest->unit_id;
        $kategoriID = $suratKeluarRequest->kategori_id;
        $perihal = $suratKeluarRequest->perihal;
        $tanggalKirim = $suratKeluarRequest->tanggal_kirim;
        $lampiranFile = $suratKeluarRequest->lampiran;

        if (!empty($lampiranFile)) {
            $lampiranFileName = $lampiranFile->getClientOriginalName();
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();

            $checkOldLampiranFile = SuratKeluar::find($id);
            $oldLampiranFile = $checkOldLampiranFile->lampiran;

            if(!empty($oldLampiranFile)){
                $deleteLampiranFile = Storage::disk('uploads')
                    ->delete('documents/surat-keluar/'.$oldLampiranFile);

                $uploadFileLampiran = Storage::disk('uploads')
                    ->putFileAs(
                        'documents/surat-keluar',
                        $lampiranFile,
                        $lampiranFileName
                    );
            }else{
                $uploadFileLampiran = Storage::disk('uploads')
                    ->putFileAs(
                        'documents/surat-keluar',
                        $lampiranFile,
                        $lampiranFileName
                    );
            }

            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim,
                'lampiran' => $lampiranFileName
            ];

            $updateSuratKeluar = SuratKeluar::where('id', $id)
                ->update($data);
        }else{
            # set array data
            $data = [
                'unit_id' => $unitID,
                'kategori_id' => $kategoriID,
                'nomor' => $nomor,
                'tujuan' => $tujuan,
                'perihal' => $perihal,
                'tanggal_kirim' => $tanggalKirim
            ];

            $updateSuratKeluar = SuratKeluar::where('id', $id)
                ->update($data);
        }

        return redirect('/surat-keluar')
            ->with([
                'notification' => 'Data berhasil disimpan!'
            ]);
    }

    public function destroy($id)
    {

        $sk = SuratKeluar::find($id);
        $lampiranFileName = $sk->lampiran;

        # check lampiran file if exist
        if (!empty($lampiranFileName)) {
            $this->lampiranFileServe->deleteLampiranFile($lampiranFileName);
        }

        SuratKeluar::destroy($id);

        return redirect('/surat-keluar')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }
}

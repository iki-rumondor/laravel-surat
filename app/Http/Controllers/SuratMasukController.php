<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use Storage;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Kategori;
use App\Models\SuratMasuk;
use App\Mail\SuratMasukMail;
use Illuminate\Http\Request;
use App\Services\LampiranFileService;
use App\Http\Requests\SuratMasukRequest;
use Auth;
use DB;

class SuratMasukController extends Controller
{
    protected $lampiranFileServe;

    public function __construct(LampiranFileService $lampiranFileService)
    {
        $this->lampiranFileServe = $lampiranFileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $role = Auth::guard('pengguna')->User()->role;

        $filter_year = $request->filter_year;
        $filter_month = $request->filter_month;
        $filter_text = strtolower($request->filter_text);

        $suratMasuk = SuratMasuk::where(function ($q) use ($filter_text, $filter_year, $filter_month) {
                if ($filter_text) {
                    $q->whereRaw(DB::raw("(
                        LOWER(nomor) LIKE '%" . $filter_text . "%'
                        OR LOWER(perihal) LIKE '%" . $filter_text . "%'
                    )"));
                }
                if ($filter_year) {
                    $q->whereRaw(DB::raw("(
                        DATE_FORMAT(tanggal_terima,'%Y') = '" . $filter_year . "'
                    )"));
                }
                if ($filter_month) {
                    $q->whereRaw(DB::raw("(
                        DATE_FORMAT(tanggal_terima,'%m') = '" . $filter_month . "'
                    )"));
                }
            })
            ->orderBy('status', 'asc')
            ->paginate(5);

        $jenis = [
            "Dokumen",
            "Surat Rangga",
            "Surat Harian",
        ];

        $kategori_pengguna = [
            "Sekretaris",
            "Kabid Penanaman Modal",
            "Kabid Pelayanan Satu Pintu",
        ];

        if ($request->cetak == 'cetak') {
            return view('surat_masuk.index', compact('filter_year', 'filter_text', 'suratMasuk', 'jenis'));
        } else {
            return view('surat_masuk.surat_masuk', compact('filter_year', 'filter_text', 'suratMasuk', 'jenis', 'kategori_pengguna'));
        }
    }

    public function create()
    {
        return view('surat_masuk.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratMasukRequest $request)
    {
        # set array data
        $data = [
            // 'kategori' => $request->kategori,
            'unit' => $request->unit,
            'jenis' => $request->jenis,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'perihal' => $request->perihal,
            'ttd' => $request->ttd,
            'status' => 'Disimpan',
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

        SuratMasuk::create($data);

        return redirect('/surat-masuk')
            ->with([
                'status' => 'success',
                'notification' => 'Data berhasil disimpan!'
            ]);
    }

    public function edit($id)
    {
        $checkSuratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk = $checkSuratMasuk;

        return view('surat_masuk.form_edit', compact('suratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratMasukRequest $suratMasukRequest, $id)
    {
        # set variable
        $nomor = $suratMasukRequest->nomor;
        $unit = $suratMasukRequest->unit;
        $perihal = $suratMasukRequest->perihal;
        $tanggalTerima = $suratMasukRequest->tanggal_terima;
        $lampiranFile = $suratMasukRequest->lampiran;

        if (!empty($lampiranFile)) {
            $lampiranFileName = $lampiranFile->getClientOriginalName();
            $lampiranFileExtension = $lampiranFile->getClientOriginalExtension();

            $checkOldLampiranFile = SuratMasuk::find($id);
            $oldLampiranFile = $checkOldLampiranFile->lampiran;

            if (!empty($oldLampiranFile)) {
                $deleteLampiranFile = Storage::disk('uploads')
                    ->delete('documents/surat-masuk/' . $oldLampiranFile);

                $uploadLampiranFile = $this
                    ->lampiranFileServe
                    ->uploadLampiranFile($lampiranFile, $lampiranFileName);
            } else {
                $uploadLampiranFile = $this
                    ->lampiranFileServe
                    ->uploadLampiranFile($lampiranFile, $lampiranFileName);
            }

            # set array data
            $data = [
                'unit' => $unit,
                'nomor' => $nomor,
                'perihal' => $perihal,
                'tanggal_terima' => $tanggalTerima,
                'lampiran' => $lampiranFileName
            ];

            $storeSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);
        } else {
            # set array data
            $data = [
                'unit' => $unit,
                'nomor' => $nomor,
                'perihal' => $perihal,
                'tanggal_terima' => $tanggalTerima
            ];

            $storeSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);
        }

        return redirect('/surat-masuk')
            ->with([
                'notification' => 'Data berhasil disimpan!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findSuratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk = SuratMasuk::find($id);
        $lampiranFileName = $suratMasuk->lampiran;

        # check lampiran file if exist
        if (!empty($lampiranFileName)) {
            $deleteLampiranFile = $this
                ->lampiranFileServe
                ->deleteLampiranFile($lampiranFileName);
        }

        $deleteSuratMasuk = SuratMasuk::destroy($id);

        return redirect('/surat-masuk')
            ->with([
                'notification' => 'Data berhasil dihapus!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($id)
    {
        $findSuratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk = SuratMasuk::with('kategori')
            ->find($id);

        $kategoriEmail   = $suratMasuk->kategori->email;
        $kategoriName    = $suratMasuk->kategori->nama;

        try {
            Mail::to($kategoriEmail)
                ->send(new SuratMasukMail($kategoriName));

            $data = [
                'status_email' => 'Terkirim'
            ];

            $updateSuratMasuk = SuratMasuk::where('id', $id)
                ->update($data);

            return redirect('/surat-masuk')
                ->with([
                    'status' => 'success',
                    'notification' => 'Email berhasil terkirim!'
                ]);
        } catch (\Exception $e) {
            return redirect('/surat-masuk')
                ->with([
                    'status' => 'warning',
                    'notification' => 'Email gagal terkirim!'
                ]);
        }
    }
}

<?php
namespace App\Http\Controllers;

use App\Http\Requests\DisposisiRequest;
use App\Models\Disposisi;
use PDF;

class PrintController extends Controller
{
    public function disposisi($id)
    {
        $logo_bonbol = base64_encode(file_get_contents(public_path('img\logo-bonbol.jpg')));
        $disposisi = Disposisi::with('surat')->find($id);
        $data = [
            'logo_bonbol' => $logo_bonbol,
            'disposisi' => $disposisi,
        ];

        return PDF::loadView('pdf.disposisi', $data)->stream('disposisi.pdf');
    }

}

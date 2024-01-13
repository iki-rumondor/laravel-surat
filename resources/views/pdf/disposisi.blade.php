<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Disposisi</title>
    <style>
        .border{
            border: 1px solid black;
        }
        .p-1{
            padding: 10px
        }
        .w-50{
            width: 50%
        }
        #logo-bonbol{
            position: absolute;
            width: 50;
            top: 15px;
            left: 15px;
        }
    </style>
</head>
<body>
    <div style="text-align: center; line-height: 0.5; border-bottom: 1px solid; margin-bottom: 15px">
        <img id="logo-bonbol" src="data:image/png;base64,{{ $logo_bonbol }}" alt="Nama Gambar">
        <div>
            <p style="font-size: 1.2em; font-weight: bold">PEMERINTAH KABUPATEN BONE BOLANGO</p>
            <p>DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU</p>
            <p>DAN TENAGA KERJA</p>
            <p>Jl. Prof. Ing. B.J. Habibie Kec. Tilongkabila, Kode Pos 96184</p>
        </div>
    </div>
    <div style="text-align: center;">
        <p style="font-size: 1em; font-weight: bold">LEMBAR DISPOSISI</p>
    </div>
    <table class="border" style="border-collapse: collapse; width: 100%;">
        <tr>
            <td class="border p-1 w-50">
                <p>Surat Dari : <b>{{ $disposisi->surat->unit }}</b></p>
            </td>
            <td class="border p-1 w-50">
                <p>Diterima Tanggal : <b>{{ date('d-m-Y', strtotime($disposisi->surat->tanggal_terima)) }}</b></p>
            </td>
        </tr>
        <tr>
            <td class="border p-1 w-50">
                <p>Tanggal Surat :  <b>{{ date('d-m-Y', strtotime($disposisi->surat->tanggal_surat)) }}</b></p>
            </td>
            <td class="border p-1 w-50">
                <p>Sifat : <b>{{ $disposisi->sifat }}</b></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px 10px ; border:1px solid black; width: 50%;">
                <p style="">Perihal : <b>{{ $disposisi->surat->perihal }}</b></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px 10px ; border:1px solid black; width: 50%;">
                <p style="">Diteruskan Kepada Saudara : <b>{{ $disposisi->kepada }}</b> </p>
                <p style="">Dengan Hormat Harap : <b>{{ $disposisi->tindakan }}</b></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px 10px ; border:1px solid black; width: 50%;">
                <p style="">Catatan : <b>{{ $disposisi->catatan }}</b></p>
            </td>
        </tr>

    </table>
    <table style="border-collapse: collapse; width: 100%">
        <tr>
            <td style="width: 50%;"></td>
            <td style="padding: 50px 10px ; width: 50%; text-align: center">
                <p style="padding-bottom: 60px;">Kepala Dinas</p>
                <p><u>JUMAIDIL, Ap. Sos, M.Ec. Dev</u></p>
                <p>NIP. 19741018 199311 1 002</p>
            </td>
        </tr>
    </table>
</body>
</html>


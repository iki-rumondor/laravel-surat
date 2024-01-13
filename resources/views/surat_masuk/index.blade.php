<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.css') }}"/>

    <title></title>
</head>
<body>
    <div class="row">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kategori</th>
                        <th scope="col">Asal Surat</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tanggal Surat</th>
                        <th scope="col">Tanggal Diterima</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Yang Bertandatangan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($suratMasuk) == 0)
                        <tr>
                            <td colspan="8" align="center"><b>Tidak ada data untuk ditampilkan</b></td>
                        </tr>
                    @endif
                    @foreach($suratMasuk as $item)
                    <tr>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->tanggal_surat)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->tanggal_terima)) }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>{{ $item->ttd }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>

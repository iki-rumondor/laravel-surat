@extends('layouts.main')

@section('title')
Dashboard &raquo; Pengguna | Aplikasi Manajemen Surat
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    Disposisi
                </h3>
                <hr />
                @if(session('notification'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session('notification') }}
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sifat</th>
                                <th scope="col">Tindakan</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($disposisi as $item)
                                <tr>
                                    <td>{{ $item->sifat }}</td>
                                    <td>{{ $item->tindakan }}</td>
                                    <td>{{ ($item->catatan == "") ? "-" : $item->catatan }}</td>
                                    <td>
                                        <button
                                            id="btnDetailSurat"
                                            data-id-surat="{{ $item->surat_masuk->id }}" data-toggle="modal"
                                            data-target="#detailModal" type="button"
                                            class="btn btn-sm btn-primary d-flex-inline align-items-center">
                                            <i class="fa fa-file mr-2"></i> Lihat Surat
                                        </button>
                                        <a target="_blank" href="{{ url('print/disposisi/'. $item->id) }}" class="btn btn-warning btn-sm">Cetak</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                          <h4 class="card-title fw-bold">Asal Surat : <span id="unit_surat"></span></h4>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Jenis: <span id="jenis_surat"></span> </li>
                          <li class="list-group-item">Tanggal Surat: <span id="tgl_surat"></span> </li>
                          <li class="list-group-item">Tanggal Terima: <span id="tgl_terima"></span> </li>
                          <li class="list-group-item">Perihal: <span id="perihal_surat"></span></li>
                          <li class="list-group-item">Yang Bertandatangan: <span id="ttd_surat"></span></li>
                        </ul>
                        <div class="card-body">
                          <a id="lampiran_surat" target="_blank" href="#" class="btn btn-info d-none">Lampiran</a>
                        </div>
                      </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#btnDetailSurat').click(function(){
            var idSurat = $(this).data('id-surat');
            console.log(idSurat);

            fetch('/fetches/surat_masuk/' + idSurat)
                .then(response => response.json())
                .then(data => {
                    $("#no_surat").text(data.nomor)
                    $("#jenis_surat").text(data.jenis)
                    $("#unit_surat").text(data.unit)
                    $("#tgl_surat").text(data.tanggal_surat)
                    $("#tgl_terima").text(data.tanggal_terima)
                    $("#perihal_surat").text(data.perihal)
                    $("#ttd_surat").text(data.ttd)
                    if(data.lampiran !== null){
                        $("#lampiran_surat").removeClass('d-none')
                        $("#lampiran_surat").prop('href', '/uploads/documents/surat-masuk/' + data.lampiran)
                    }
                })
                .catch(error => console.error('Error:', error));

        })

    </script>
@endsection

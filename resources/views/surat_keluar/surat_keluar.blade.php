@extends('layouts.main')

@section('title')
    Dashboard &raquo; Surat Keluar | Aplikasi Manajemen Surat
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Surat Keluar
                        </h3>
                        <hr />
                        @if (session('notification'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('notification') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Auth::guard('pengguna')->User()->role == 'Super Admin' || Auth::guard('pengguna')->User()->role == 'Kasubag')
                            <p>
                                <a href="/surat-keluar/form-tambah" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Tambah surat keluar
                                </a>
                            </p>
                        @endif
                        <table class="table table-striped table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Asal Surat</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Tanggal Surat</th>
                                    <th scope="col">Tanggal Diterima</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Yang Bertandatangan</th>
                                    <th scope="col">Lampiran</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratKeluar as $item)
                                    <tr>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_surat)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_terima)) }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->ttd }}</td>
                                        <td>
                                            @if ($item->lampiran != '')
                                                <a href="{{ url('uploads/documents/surat-masuk/' . $item->lampiran) }}"
                                                    class="btn btn-sm btn-primary text-white" target="_blank">
                                                    <i class="fa fa-file"></i> Lihat
                                                </a>
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/surat-keluar/hapus/' . $item->id) }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="table-responsive">
                            {{ $suratKeluar->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

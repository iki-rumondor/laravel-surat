@extends('layouts.main')

@section('title')
    Dashboard &raquo; Surat Masuk | Aplikasi Manajemen Surat
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Dokumen
                        </h3>
                        <hr />
                        @if (session('notification'))
                            <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                                {{ session('notification') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ implode('', $errors->all(':message')) }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Auth::guard('pengguna')->User()->role == 'Super Admin' || Auth::guard('pengguna')->User()->role == 'Kasubag')
                            <div>
                                <form class="form-inline">
                                    {{-- <div class="form-group mb-2">
                                        <select name="filter_unit" id="filter_unit" class="form-control"
                                            style="width: 200px">
                                            <option value="">--- Filter Unit ---</option>
                                            @foreach ($unit as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $filter_unit == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="filter_kategori" id="filter_kategori" class="form-control"
                                            style="width: 300px">
                                            <option value="">--- Filter Kategori ---</option>
                                            @foreach ($jenis as $jenis_item)
                                                <optgroup label="{{ $jenis_item }}">
                                                    @foreach ($kategori as $item)
                                                        @if ($item->jenis == $jenis_item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $filter_kategori == $item->id ? 'selected' : '' }}>
                                                                {{ $item->jenis . '-' . $item->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group mb-2">
                                        <select name="filter_year" id="filter_year" class="form-control"
                                            style="width: 100px">
                                            <option value="">--- Filter Year ---</option>
                                            @for ($y = 2019; $y <= date('Y'); $y++)
                                                <option value="{{ $y }}"
                                                    {{ $filter_year == $y ? 'selected' : '' }}>
                                                    {{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="filter_text" class="form-control"
                                            placeholder="Masukkan kata kunci" style="width: 250px"
                                            value="{{ $filter_text }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                                    <button type="submit" class="btn btn-primary mb-2 ms-2" name="cetak"
                                        value="cetak">Cetak
                                        PDF</button>
                                </form>
                            </div>
                            <hr />
                            <div>
                                <a href="{{ url('/surat-masuk/form-tambah') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Surat Masuk
                                </a>
                            </div>
                            <hr />
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Jenis</th>
                                        {{-- <th scope="col">Nomor</th> --}}
                                        <th scope="col">Tanggal Surat</th>
                                        <th scope="col">Tanggal Diterima</th>
                                        <th scope="col">Perihal</th>
                                        <th scope="col">Yang Bertandatangan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Lampiran</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($suratMasuk) == 0)
                                        <tr>
                                            <td colspan="8" align="center"><b>Tidak ada data untuk ditampilkan</b></td>
                                        </tr>
                                    @endif
                                    @foreach ($suratMasuk as $item)
                                        <tr>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            {{-- <td>{{ $item->nomor }}</td> --}}
                                            <td>{{ date('d-m-Y', strtotime($item->tanggal_surat)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tanggal_terima)) }}</td>
                                            <td>{{ $item->perihal }}</td>
                                            <td>{{ $item->ttd }}</td>
                                            <td> <span class="badge badge-{{ ($item->status == 'Disposisi') ? 'warning' : 'success' }}">{{ $item->status }}</span></td>
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
                                                @if (Auth::guard('pengguna')->User()->role == 'Kadis')
                                                    @if ($item->status == 'Disimpan')
                                                        <button data-id-surat="{{ $item->id }}" data-toggle="modal"
                                                            data-target="#addModal" type="button"
                                                            class="btn btn-sm btn-primary d-flex align-items-center">
                                                            <i class="fa fa-file mr-2"></i> Disposisi
                                                        </button>
                                                    @endif
                                                @else
                                                    @if($item->status != "Disposisi")
                                                    <a href="{{ url('/surat-masuk/hapus/' . $item->id) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i> Hapus
                                                    </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $suratMasuk->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action={{ url('disposisi') }} method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Disposisi Surat Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="surat_id" id="modalIDSurat">
                        <div class="form-group">
                            <label for="sifat">Sifat Surat</label>
                            <select name="sifat" class="form-control" id="sifat">
                                <option>Sangat Segera</option>
                                <option>Segera</option>
                                <option>Rahasia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kepada">Diteruskan Kepada Saudara</label>
                            <select name="kepada" class="form-control" id="kepada">
                                <option>Sekretaris</option>
                                <option>Kabid Penanaman Modal & Promosi</option>
                                <option>Kabid Pelayanan Terpadu Satu Pintu</option>
                                <option>Kabid Penempatan, Perluasan Kesempatan Kerja dan Hubungan Jamsostek</option>
                                <option>Kasubag Perencanaan Program</option>
                                <option>Kasubag Keuangan</option>
                                <option>Kasubag Umum & Kepegawaian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tindakan">Dengan Hormat Harap</label>
                            <select name="tindakan" class="form-control" id="tindakan">
                                <option>Untuk Di Tindak Lanjuti</option>
                                <option>Proses Lebih Lanjut</option>
                                <option>Konsultasikan</option>
                                <option>Koordinasikan/Konfirmasikan</option>
                                <option>Untuk Diketahui</option>
                                <option>Untuk Menjadi Pedoman</option>
                                <option>Untuk Menjadi Perhatian</option>
                                <option>Tanggapan dan Saran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <input type="text" class="form-control" name="catatan" id="catatan"
                                placeholder="Masukkan Catatan (Optional)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#addModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idSurat = button.data('id-surat');

            var modal = $(this);
            modal.find('#modalIDSurat').val(idSurat);
        });
    </script>
@endsection

@extends('layouts.main')

@section('title')
    Dashboard &raquo; Surat Keluar | Aplikasi Manajemen Surat
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Tambah surat keluar
                        </h3>
                        <hr />
                        <form action="/surat-keluar/simpan" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="kategori">Kategori</label>
                                        <input type="text" name="kategori"
                                            class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}"
                                            value="{{ old('kategori') }}" />
                                        @if ($errors->has('kategori'))
                                            <span class="invalid-feedback">
                                                <strong>
                                                    {{ $errors->first('kategori') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="unit">Asal Surat</label>
                                        <input type="text" name="unit"
                                            class="form-control {{ $errors->has('unit') ? ' is-invalid' : '' }}"
                                            value="{{ old('unit') }}" />
                                        @if ($errors->has('unit'))
                                            <span class="invalid-feedback">
                                                <strong>
                                                    {{ $errors->first('unit') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="jenis">Jenis *</label>
                                        <select name="jenis" id="jenis"
                                            class="form-control {{ $errors->has('kategori_id') ? ' is-invalid' : '' }}">
                                            <option value="">--- Pilih Jenis ---</option>
                                            <option value="Nota Dinas">Nota Dinas</option>
                                            <option value="Undangan">Undangan</option>
                                            <option value="Radiogram">Radiogram</option>
                                            <option value="Perintah Tugas">Perintah Tugas</option>
                                            <option value="Telaah">Telaah</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @if ($errors->has('jenis'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('jenis') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="tanggal-surat">Tanggal Surat *</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control tanggal_surat {{ $errors->has('tanggal_surat') ? ' is-invalid' : '' }}"
                                                id="tanggal-surat" style="cursor: pointer" readonly />
                                            <input type="hidden" name="tanggal_surat" id="input-tanggal-surat" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            @if ($errors->has('tanggal_surat'))
                                                <span class="invalid-feedback">
                                                    <strong>
                                                        {{ $errors->first('tanggal_surat') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="tanggal-keluar">Tanggal Keluar *</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control {{ $errors->has('tanggal_keluar') ? ' is-invalid' : '' }}"
                                                id="tanggal-keluar" style=" cursor: pointer" readonly />
                                            <input type="hidden" name="tanggal_keluar" id="input-tanggal-keluar" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            @if ($errors->has('tanggal_keluar'))
                                                <span class="invalid-feedback">
                                                    <strong>
                                                        {{ $errors->first('tanggal_keluar') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="perihal">Perihal *</label>
                                        <input type="text" name="perihal"
                                            class="form-control {{ $errors->has('perihal') ? ' is-invalid' : '' }}"
                                            value="{{ old('perihal') }}" />
                                        @if ($errors->has('perihal'))
                                            <span class="invalid-feedback">
                                                <strong>
                                                    {{ $errors->first('perihal') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="ttd">Yang Bertandatangan *</label>
                                        <input type="text" name="ttd"
                                            class="form-control {{ $errors->has('ttd') ? ' is-invalid' : '' }}"
                                            value="{{ old('ttd') }}" />
                                        @if ($errors->has('ttd'))
                                            <span class="invalid-feedback">
                                                <strong>
                                                    {{ $errors->first('ttd') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label for="lampiran">Lampiran</label>
                                        <input type="file" name="lampiran"
                                            class="form-control {{ $errors->has('lampiran') ? ' is-invalid' : '' }}" />
                                        @if ($errors->has('lampiran'))
                                            <span class="invalid-feedback">
                                                <strong>
                                                    {{ $errors->first('lampiran') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <p>
                                <code>
                                    Label bertanda (*) wajib diisi atau dipilih
                                </code>
                            </p>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>
    <script type="text/javascript">
        $('#asal-bagian').click(function() {
            // set variable
            var jabatan_id = $(this).val();
            var pegawai_options = '';

            if (jabatan_id != 0) {
                // set ajax
                $.ajax({
                    url: '/pegawai/api/cari-pegawai-dari-bagian/' + jabatan_id,
                    data: 'get',
                    success: function(result) {
                        if (result != undefined) {
                            if (result.length != 0) {
                                // empty the options on select
                                $('#asal-pegawai').empty();
                                $('#asal-pegawai').removeAttr('readonly');

                                // foreach the result assign into variable
                                $.each(result, function(key, value) {
                                    pegawai_options =
                                        '<option value="' + value.id + '">' +
                                        value.nama +
                                        '</option>';

                                    // append into select tujuan pegawai
                                    $('#asal-pegawai').append(pegawai_options);
                                });
                            } else {
                                $('#asal-pegawai').empty();

                                pegawai_options =
                                    '<option value="">' +
                                    '--- Belum Ada Pegawai Di Bagian Ini ---' +
                                    '</option>';

                                $('#asal-pegawai').append(pegawai_options);
                                $('#asal-pegawai').attr('readonly', true);
                            }
                        }
                    },
                    error: function(result) {
                        alert(result);
                    }
                });
            } else {
                $('#asal-pegawai').empty();

                pegawai_options =
                    '<option value="">' +
                    '--- Pilih Bagian Terlebih Dahulu ---' +
                    '</option>';

                $('#asal-pegawai').append(pegawai_options);
                $('#asal-pegawai').attr('readonly', true);
            }
        });

        $('#tanggal-surat').datepicker({
            language: 'id',
            todayHighlight: true,
            format: {
                toDisplay: function(date, format, language) {
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var full_date = day + '/' + month + '/' + year
                    var real_full_date = year + '-' + month + '-' + day;

                    $('#input-tanggal-surat').val(real_full_date);

                    return full_date;
                },
                toValue: function(date, format, language) {
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var full_date = year + '-' + month + '-' + date

                    return full_date;
                }
            }
        });

        $('#tanggal-keluar').datepicker({
            language: 'id',
            todayHighlight: true,
            format: {
                toDisplay: function(date, format, language) {
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var full_date = day + '/' + month + '/' + year
                    var real_full_date = year + '-' + month + '-' + day;

                    $('#input-tanggal-keluar').val(real_full_date);

                    return full_date;
                },
                toValue: function(date, format, language) {
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var full_date = year + '-' + month + '-' + date

                    return full_date;
                }
            }
        });
    </script>
@endsection

@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@section('title')
<strong>BERANDA</strong>
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">TAMBAH PASIEN</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form method="post" action="/entri/data/pasien/add">
                @csrf
                <div class="card-body" style="display: block;">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No BPJS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noKartu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA PASIEN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
                        <div class="col-sm-10">
                            <select name="sex" class="form-control" required>
                                <option value="">-pilih-</option>
                                <option value="L"> Laki-laki</option>
                                <option value="P"> Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tglLahir" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALAMAT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TELP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">SIMPAN</button><br />
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>

@endsection

@push('js')

@endpush
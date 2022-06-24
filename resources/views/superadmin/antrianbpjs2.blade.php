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
                <h3 class="card-title">DAFTAR BPJS</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form method="post" action="/daftarantrian/bpjs">
                @csrf
                <div class="card-body" style="display: block;">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NO KARTU</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="noKartu" value="{{$data->noKartu}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik" value="{{$data->noKTP}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA PASIEN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" class="form-control" readonly>
                                <option value="">-pilih-</option>
                                <option value="L" {{$data->sex == 'L' ? 'selected':''}}> Laki-laki</option>
                                <option value="P" {{$data->sex == 'P' ? 'selected':''}}> Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL LAHIR</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_lahir"
                                value="{{\Carbon\Carbon::parse($data->tglLahir)->format('Y-m-d')}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">POLI</label>
                        <div class="col-sm-10">
                            <select name="poli_id" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($poli as $item)
                                <option value="{{$item->id}}"> {{$item->nmPoli}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL DAFTAR</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal"
                                value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">DAFTAR</button><br />
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
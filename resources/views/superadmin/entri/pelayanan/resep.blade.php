@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('title')
<strong>BERANDA</strong>
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-md-3">
        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{$data->nama}}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{hitungUmur($data->tglLahir)}}</b>
                    </li>
                    <li class="list-group-item">
                        <b>{{$data->nmPoli}}</b>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pasien</h3>
            </div><!-- /.card-header -->
            <div class="card-body">

            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">RESEP</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form method="post" action="/entri/data/pelayanan/resep/{{$data->id}}">
                @csrf
                <div class="card-body" style="display: block;">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ID PENDAFTARAN</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$data->id}}" name="t_pendaftaran_id" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KODE & NAMA OBAT</label>
                        <div class="col-sm-10">
                            <select name="m_obat_id" class="form-control select2" required>
                                <option value="">-pilih-</option>
                                @foreach ($obat as $item)
                                <option value="{{$item->id}}">{{$item->kode}}, {{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SIGNA 1</label>
                        <div class="col-sm-10">
                            <input type="text" name="signa1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SIGNA 2</label>
                        <div class="col-sm-10">
                            <input type="text" name="signa2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jumlah Obat</label>
                        <div class="col-sm-10">
                            <input type="text" name="jmlObat" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jumlah Permintaan</label>
                        <div class="col-sm-10">
                            <input type="text" name="jmlPermintaan" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">SIMPAN RESEP</button><br />
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>


<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">LIST RESEP PASIEN</h3>
                <div class="card-tools">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-2">
                <table id="example1" class="table table-bordered table-sm">
                    <thead>
                        <tr class="bg-primary text-sm">
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Signa 1</th>
                            <th>Signa 2</th>
                            <th>Jml Obat</th>
                            <th>Jml Permintaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    @if ($myResep != null)
                    <tbody>
                        @foreach ($myResep as $key => $item)
                        <tr style="font-size: 12px">
                            <td>{{$no++}}</td>
                            <td>{{$item->kode}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->signa1}}</td>
                            <td>{{$item->signa2}}</td>
                            <td>{{$item->jmlObat}}</td>
                            <td>{{$item->jmlPermintaan}}</td>
                            <td>
                                <a href="/entri/data/pelayanan/resep/{{$item->id}}/delete"
                                    onclick="return confirm('Yakin Di Hapus?');"><span
                                        class="badge badge-danger">delete</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@push('js')

<script src="/admin/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
</script>
@endpush
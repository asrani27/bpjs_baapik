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
                <h3 class="card-title">PILIH ASURANSI</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <a href="/daftarantrian/umum" class="btn btn-block btn-primary">UMUM</a><br />
                <a href="/daftarantrian/bpjs" class="btn btn-block btn-primary">BPJS</a><br />
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>

@endsection

@push('js')

@endpush
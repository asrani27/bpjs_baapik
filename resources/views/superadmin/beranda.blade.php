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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="user-block">
                    <span class="username"><a href="#">STATUS BRIDGING BPJS</a>
                        @if (Auth::user()->is_connect == 0)
                        <span class="badge badge-danger">Not Connected</span>
                        @else
                        <span class="badge badge-success">Connected</span>
                        @endif</span>
                    <span class="description">Jika Tidak terkoneksi dengan bpjs, silahkan klik <a
                            href="/setting/data/bpjs">disini</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        {{-- <form method="post" action="/beranda/url/update">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">BASE URL INTEGRASI</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL AKTIVITAS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tpp" value="{{$base->tpp}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL PRESENSI</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="presensi" value="{{$base->presensi}}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit"
                                        class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}
    </div>
</div>

@endsection

@push('js')

@endpush
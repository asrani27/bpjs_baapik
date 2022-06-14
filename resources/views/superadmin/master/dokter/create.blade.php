@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')

@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/datamaster/data/dokter/add">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Dokter</h3>
                            <div class="card-tools">
                                <a href="/datamaster/data/dokter" type="button" class="btn bg-gradient-blue btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{--
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Dokter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kdDokter" required>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Dokter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nmDokter" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit"
                                        class="btn btn-block btn-primary"><strong>SIMPAN</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush
@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
TAMBAH SATUAN
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/periode/edit/{{$data->id}}">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Periode</h3>
                            <div class="card-tools">
                                <a href="/periode" type="button" class="btn bg-gradient-blue btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-10">
                                    <select name="bulan" class="form-control">
                                        <option value="">-pilih-</option>
                                        <option value="01" {{$data->bulan == '01' ? 'selected':''}}>Januari</option>
                                        <option value="02" {{$data->bulan == '02' ? 'selected':''}}>Februari</option>
                                        <option value="03" {{$data->bulan == '03' ? 'selected':''}}>Maret</option>
                                        <option value="04" {{$data->bulan == '04' ? 'selected':''}}>April</option>
                                        <option value="05" {{$data->bulan == '05' ? 'selected':''}}>Mei</option>
                                        <option value="06" {{$data->bulan == '06' ? 'selected':''}}>Juni</option>
                                        <option value="07" {{$data->bulan == '07' ? 'selected':''}}>Juli</option>
                                        <option value="08" {{$data->bulan == '08' ? 'selected':''}}>Agustus</option>
                                        <option value="09" {{$data->bulan == '09' ? 'selected':''}}>September</option>
                                        <option value="10" {{$data->bulan == '10' ? 'selected':''}}>Oktober</option>
                                        <option value="11" {{$data->bulan == '11' ? 'selected':''}}>November</option>
                                        <option value="12" {{$data->bulan == '12' ? 'selected':''}}>Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tahun" value="{{$data->tahun}}"
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
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush
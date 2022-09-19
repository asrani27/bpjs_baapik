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
                {{-- <a href="/entri/data/pelayanan/anamnesa/{{$id}}/kunjungan">Get Kunjungan</a> --}}
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
                <h3 class="card-title">ANAMNESA</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <form method="post" action="/entri/data/pelayanan/anamnesa/{{$data->id}}/update">
                @csrf
                <div class="card-body" style="display: block;">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ID PENDAFTARAN</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$data->id}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PETUGAS MEDIS</label>
                        <div class="col-sm-10">
                            <select name="m_dokter_id" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($dokter as $item)
                                <option value="{{$item->id}}" {{$anamnesa->m_dokter_id == $item->id ?
                                    'selected':''}}>{{$item->nmDokter}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KESADARAN</label>
                        <div class="col-sm-10">
                            <select name="m_kesadaran_id" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($kesadaran as $item)
                                <option value="{{$item->id}}" {{$anamnesa->m_kesadaran_id == $item->id ?
                                    'selected':''}}>{{$item->nmSadar}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KELUHAN</label>
                        <div class="col-sm-10">
                            <input type="text" name="keluhan" class="form-control" value="{{$anamnesa->keluhan}}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SUHU</label>
                        <div class="col-sm-10">
                            <input type="text" name="suhu" class="form-control" value="{{$anamnesa->suhu}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TINGGI BADAN</label>
                        <div class="col-sm-1">
                            <input type="text" name="tinggiBadan" id="tb" class="form-control" required
                                value="{{$anamnesa->tinggiBadan}}" onKeyPress="edValueKeyPress()"
                                onKeyUp="edValueKeyPress()">
                        </div>
                        <label class="col-sm-2 col-form-label">cm</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">BERAT BADAN</label>
                        <div class="col-sm-1">
                            <input type="text" name="beratBadan" id="bb" class="form-control" required
                                onKeyPress="edValueKeyPress()" onKeyUp="edValueKeyPress()"
                                value="{{$anamnesa->beratBadan}}">
                        </div>
                        <label class="col-sm-2 col-form-label">kg</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">LINGKAR PERUT</label>
                        <div class="col-sm-10">
                            <input type="text" name="lingkarPerut" class="form-control" required
                                value="{{$anamnesa->lingkarPerut}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">IMT</label>
                        <div class="col-sm-10">
                            <input type="text" name="imt" class="form-control" id="lblValue" readonly
                                value="{{$anamnesa->imt}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SISTOLE</label>
                        <div class="col-sm-10">
                            <input type="text" name="sistole" class="form-control" value="{{$anamnesa->sistole}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">DIASTOLE</label>
                        <div class="col-sm-10">
                            <input type="text" name="diastole" class="form-control" value="{{$anamnesa->diastole}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">RESPRATE</label>
                        <div class="col-sm-10">
                            <input type="text" name="respRate" class="form-control" value="{{$anamnesa->respRate}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">HEARTRATE</label>
                        <div class="col-sm-10">
                            <input type="text" name="heartRate" class="form-control" value="{{$anamnesa->heartRate}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TERAPI OBAT</label>
                        <div class="col-sm-10">
                            <input type="text" name="terapi" class="form-control" required
                                value="{{$anamnesa->terapi}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TERAPI NON OBAT</label>
                        <div class="col-sm-10">
                            <input type="text" name="terapinonobat" class="form-control" required
                                value="{{$anamnesa->terapinonobat}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN</label>
                        <div class="col-sm-10">
                            <input type="text" name="keterangan" class="form-control" value="{{$anamnesa->keterangan}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS PULANG</label>
                        <div class="col-sm-10">
                            <select name="m_status_pulang_id" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($statuspulang as $item)
                                <option value="{{$item->id}}" {{$anamnesa->m_status_pulang_id == $item->id ?
                                    'selected':''}}>{{$item->nmStatusPulang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">UPDATE ANAMNESA</button><br />
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>

@endsection

@push('js')

<script>
    function edValueKeyPress()
    {
        var tb = document.getElementById("tb");
        var stb = tb.value**2;
    
        var bb = document.getElementById("bb");
        var sbb = bb.value;

        var result = (sbb / stb) * 10000;
        var lblValue = document.getElementById("lblValue").value = result.toFixed(2);
    }
</script>
@endpush
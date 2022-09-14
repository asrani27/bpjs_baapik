@extends('layouts.app')
@push('css')
@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATA STATUS PULANG</h3>
                <div class="card-tools">
                    <a href="/datamaster/data/statuspulang" type="button" class="btn btn-xs bg-gradient-blue">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                <form method="post" action="/datamaster/data/statuspulang/getstatuspulang">
                    @csrf
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label>Rawat Inap ?</label>
                    </div>
                    <div class="col-sm-10">
                        <select class="form-control" name="param1">
                            <option value="true" {{old('param1') == 'true' ? 'selected':''}}>TRUE</option>
                            <option value="false" {{old('param1') == 'false' ? 'selected':''}}>FALSE</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary btn-block">Get Status Pulang</button>
                    </div>
                </div>
                </form>
                @if ($data != null)

                <form method="post" action="/datamaster/data/statuspulang/add/simpanjson">
                    @csrf
                    <input type="hidden" value="{{json_encode($data->list)}}" name="jsonDiag">
                    <button type="submit" class="btn btn-success btn-block">Simpan Ke Lokal</button>
                </form>
                    Data Ditemukan<br/>
                    Jumlah : {{$data->count}}<br/>
                    Lihat Data : 
                    @foreach ($data->list as $item)
                        <li>{{$item->kdStatusPulang}} - {{$item->nmStatusPulang}}</li>
                    @endforeach
                    
                @else
                    
                @endif
            </div>
            
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-sm">
                Service Poli :<br />
                -Get Poli
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
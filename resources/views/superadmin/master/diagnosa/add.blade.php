@extends('layouts.app')
@push('css')
@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATA DIAGNOSA</h3>
                <div class="card-tools">
                    <a href="/datamaster/data/diagnosa" type="button" class="btn btn-xs bg-gradient-blue">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                <form method="post" action="/datamaster/data/diagnosa/add">
                    @csrf
                <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="inputEmail3" name="cari" value="{{old('cari')}}" placeholder="Cari Diagnosa" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary btn-block">Cari</button>
                    </div>
                </div>
                </form>
                
                @if ($data != null)

                <form method="post" action="/datamaster/data/diagnosa/add/simpanjson">
                    @csrf
                    <input type="hidden" value="{{json_encode($data->list)}}" name="jsonDiag">
                    <button type="submit" class="btn btn-success btn-block">Simpan Ke Lokal</button>
                </form>
                    Data Ditemukan<br/>
                    Jumlah : {{$data->count}}<br/>
                    Lihat Data : 
                    @foreach ($data->list as $item)
                        <li>{{$item->kdDiag}} - {{$item->nmDiag}}</li>
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
                Service Diagnosa :<br />
                -Pencarian Diagnosa
                <br />
                -Pencarian Diagnosa Tidak Ditemukan

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
@extends('layouts.app')
@push('css')
@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATA KESADARAN</h3>
                <div class="card-tools">
                    <a href="/datamaster/data/kesadaran" type="button" class="btn btn-xs bg-gradient-blue">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                <div class="form-group row">
                    <div class="col-sm-12">
                      <a href="/datamaster/data/kesadaran/getsadar" class="btn btn-primary btn-block">Get Kesadaran</a>
                    </div>
                </div>
                
                @if ($data != null)

                <form method="post" action="/datamaster/data/kesadaran/add/simpanjson">
                    @csrf
                    <input type="hidden" value="{{json_encode($data->list)}}" name="jsonDiag">
                    <button type="submit" class="btn btn-success btn-block">Simpan Ke Lokal</button>
                </form>
                    Data Ditemukan<br/>
                    Jumlah : {{$data->count}}<br/>
                    Lihat Data : 
                    @foreach ($data->list as $item)
                        <li>{{$item->kdSadar}} - {{$item->nmSadar}}</li>
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
                Service Kesadaran :<br />
                -Pencarian Kesadaran
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
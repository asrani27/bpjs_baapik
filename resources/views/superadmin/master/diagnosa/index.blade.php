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
                    <a href="/datamaster/data/diagnosa/sync" type="button" class="btn bg-gradient-blue btn-sm">
                        <i class="fas fa-sync"></i> Sinkron Data</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-2">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Diagnosa</th>
                            <th>Nama Diagnosa</th>
                            <th>Non Spesialis</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{1 + $key}}</td>
                            <td>{{$item->kdDiag}}</td>
                            <td>{{$item->nmDiag}}</td>
                            <td>{{$item->nonSpesialis}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$data->links()}}
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-sm">
                Informasi :<br />
                <span class="text-success"> <i class="fa fa-check"></i></span> Data Bridging Dari PCARE
                <br />
                <span class="text-danger"> <i class="fa fa-times"></i></span> Data Lokal Dari Aplikasi

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')


@endpush
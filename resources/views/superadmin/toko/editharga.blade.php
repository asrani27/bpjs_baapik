@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
EDIT HARGA BARANG
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/toko/barang/editharga/{{$barang_id}}/{{$toko_id}}">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Harga Barang</h3>
                            {{-- <div class="card-tools">
                                <a href="/barang" type="button" class="btn bg-gradient-blue btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Toko</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="toko"
                                        value="{{$data == null ? $toko->nama:$data->toko->nama}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama"
                                        value="{{$data == null ? $barang->nama:$data->barang->nama}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga Modal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga_modal"
                                        onkeypress="return hanyaAngka(event)"
                                        value="{{($data == null ? 0: $data->harga_modal) == null ? 0: $data->harga_modal}}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga Grosir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga_grosir"
                                        onkeypress="return hanyaAngka(event)"
                                        value="{{($data == null ? 0: $data->harga_grosir) == null ? 0: $data->harga_grosir}}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga Jual</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga"
                                        onkeypress="return hanyaAngka(event)"
                                        value="{{($data == null ? 0: $data->harga) == null ? 0: $data->harga}}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga Final</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga_jual"
                                        onkeypress="return hanyaAngka(event)"
                                        value="{{($data == null ? 0: $data->harga_jual) == null ? 0: $data->harga_jual}}"
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

<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>

@endpush
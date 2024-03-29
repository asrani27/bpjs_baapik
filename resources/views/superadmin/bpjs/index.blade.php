@extends('layouts.app')
@push('css')

@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">KONFIGURASI BRIDGING BPJS</h3>
                <div class="card-tools">
                </div>
            </div>
            <form method="post" action="/setting/data/bpjs">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>AKUN PRODUCTION :</label>
                    </div>
                    <div class="form-group">
                        <label>CONS ID</label>
                        <input type="text" class="form-control" name="cons_id"
                            value="{{$data == null ? '': $data->cons_id}}">
                    </div>
                    <div class="form-group">
                        <label>SECRET KEY</label>
                        <input type="text" class="form-control" name="secret_key"
                            value="{{$data == null ? '': $data->secret_key}}">
                    </div>
                    <div class="form-group">
                        <label>USER PCARE</label>
                        <input type="text" class="form-control" name="user_pcare"
                            value="{{$data == null ? '': $data->user_pcare}}">
                    </div>

                    <div class="form-group">
                        <label>PASS PCARE</label>
                        <input type="text" class="form-control" name="pass_pcare"
                            value="{{$data == null ? '': $data->pass_pcare}}">
                    </div>

                    <div class="form-group">
                        <label>AKUN DEVELOPMENT :</label>
                    </div>
                    
                    <div class="form-group">
                        <label>CONS ID</label>
                        <input type="text" class="form-control" name="cons_id_dev"
                            value="{{$data == null ? '': $data->cons_id_dev}}">
                    </div>
                    <div class="form-group">
                        <label>SECRET KEY</label>
                        <input type="text" class="form-control" name="secret_key_dev"
                            value="{{$data == null ? '': $data->secret_key_dev}}">
                    </div>
                    <div class="form-group">
                        <label>USER PCARE</label>
                        <input type="text" class="form-control" name="user_pcare_dev"
                            value="{{$data == null ? '': $data->user_pcare_dev}}">
                    </div>

                    <div class="form-group">
                        <label>PASS PCARE</label>
                        <input type="text" class="form-control" name="pass_pcare_dev"
                            value="{{$data == null ? '': $data->pass_pcare_dev}}">
                    </div>

                    <div class="form-group">
                        <label>User Key</label>
                        <input type="text" class="form-control" name="user_key"
                            value="{{$data == null ? '': $data->user_key}}">
                    </div>
                    
                    <div class="form-group">
                        <label>Mode</label>
                        <select class="form-control" name="mode">
                            <option value="0" {{$data->mode == 0 ? 'selected':''}}>Development</option>
                            <option value="1" {{$data->mode == 1 ? 'selected':''}}>Production</option>
                        </select>
                    </div>
                    

                    <div class="form-group">
                        <label>STATUS</label><br />
                        @if (Auth::user()->is_connect == 0)
                        <span class="badge badge-danger">Not Connected</span>
                        @else
                        <span class="badge badge-success">Connected</span>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-block btn-success"><i class="fas fa-save"></i>
                            Update</button>
                        <a href="/setting/data/bpjs/connect" class="btn btn-block btn-warning"><i
                                class="fas fa-recycle"></i>
                            Test Connection</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
@extends('layouts.app')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <form method="post" action="/entri/data/pendaftaran">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal"
                                max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{old('tanggal')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kunjungan</label>
                        <div class="col-sm-10">
                            <select name="jenis_kunjungan" class="form-control">
                                <option value="0" {{old('jenis_kunjungan')=='0' ? 'selected' :''}}>Semua</option>
                                <option value="1" {{old('jenis_kunjungan')=='1' ? 'selected' :''}}>Kunjungan Sakit
                                </option>
                                <option value="2" {{old('jenis_kunjungan')=='2' ? 'selected' :''}}>Kunjungan Sehat
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" type="button" name="button" value="tarik"
                                class="btn bg-gradient-blue btn-sm">
                                <i class="fas fa-sync"></i> Tarik Data</button>
                            <button type="submit" type="button" name="button" value="tampil"
                                class="btn bg-gradient-blue btn-sm">
                                <i class="fas fa-sync"></i> Tampilkan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">RIWAYAT PENDAFTARAN PESERTA</h3>
                <div class="card-tools">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-2">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No</th>
                            <th>No Kartu</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tgl Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$item->tglDaftar}}</td>
                            <td>{{$item->noUrut}}</td>
                            <td>{{$item->noKartu}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->sex}}</td>
                            <td>{{$item->tglLahir}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

<!-- DataTables  & Plugins -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/admin/plugins/jszip/jszip.min.js"></script>
<script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush
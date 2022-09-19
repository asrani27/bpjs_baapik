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
            <form method="post" action="/entri/data/pelayanan">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="tanggal"
                                max="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                value="{{old('tanggal') == null ? \Carbon\Carbon::now()->format('Y-m-d') : old('tanggal')}}"
                                required>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" type="button" name="button" value="tampil"
                                class="btn bg-gradient-blue btn">
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
                <h3 class="card-title">PELAYANAN PASIEN</h3>
                <div class="card-tools">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-2">
                <table id="example1" class="table table-bordered table-sm">
                    <thead>
                        <tr class="bg-primary text-sm">
                            <th>Tanggal</th>
                            <th>No</th>
                            <th>NIK</th>
                            <th>No Kartu</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tgl Lahir</th>
                            <th>Usia</th>
                            <th>Jenis</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Bridging?</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr style="font-size: 12px">
                            <td>{{$item->tglDaftar}}</td>
                            <td>{{$item->noUrut}}</td>
                            <td>{{$item->nik}}</td>
                            <td>{{$item->noKartu}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->sex}}</td>
                            <td>{{$item->tglLahir}}</td>
                            <td>{{hitungUmur($item->tglLahir)}}</td>
                            <td>{{$item->jenis}}</td>
                            <td>{{$item->nmPoli}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                @if ($item->jenis != 'UMUM')
                                @if ($item->noUrut != null)
                                <span class="badge badge-success">sudah</span>
                                @else
                                <span class="badge badge-danger">belum</span>
                                @endif
                                @endif
                            </td>
                            <td>
                                @if ($item->anamnesa != null)
                                <a href="/entri/data/pelayanan/anamnesa/{{$item->id}}"><span
                                        class="badge badge-success">ANAMNESA</span></a>
                                @else
                                <a href="/entri/data/pelayanan/anamnesa/{{$item->id}}"><span
                                        class="badge badge-danger">ANAMNESA</span></a>
                                @endif

                                @if ($item->diagnosa->first() != null)
                                <a href="/entri/data/pelayanan/diagnosa/{{$item->id}}"><span
                                        class="badge badge-success">DIAGNOSA</span></a>
                                @else
                                <a href="/entri/data/pelayanan/diagnosa/{{$item->id}}"><span
                                        class="badge badge-danger">DIAGNOSA</span></a>
                                @endif

                                @if ($item->resep->first() != null)
                                <a href="/entri/data/pelayanan/resep/{{$item->id}}"><span
                                        class="badge badge-success">RESEP</span></a>
                                @else
                                <a href="/entri/data/pelayanan/resep/{{$item->id}}"><span
                                        class="badge badge-danger">RESEP</span></a>
                                @endif
                            

                                @if ($item->tindakan->first() != null)
                                <a href="/entri/data/pelayanan/tindakan/{{$item->id}}"><span
                                        class="badge badge-success">TINDAKAN</span></a>
                                @else
                                <a href="/entri/data/pelayanan/tindakan/{{$item->id}}"><span
                                        class="badge badge-danger">TINDAKAN</span></a>
                                @endif

                                @if ($item->status != 'Sudah dilayani')
                                <a href="/entri/data/pelayanan/selesai/{{$item->id}}"
                                    onclick="return confirm('Sudah Selesai?');"><span
                                        class="badge badge-primary">SELESAI</span></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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
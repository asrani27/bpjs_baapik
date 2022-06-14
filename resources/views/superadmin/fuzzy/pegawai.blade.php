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
            <div class="card-header">
                <h3 class="card-title">Data Perhitungan Fuzzy Tsukamoto</h3>
                <div class="card-tools">
                    {{-- <a href="/fuzzy/periode/{{$periode->id}}/skpd/{{$skpd->id}}/tarikaktivitas" type="button"
                        class="btn bg-gradient-blue btn-sm">
                        TARIK AKTIVITAS</a> --}}
                    <a href="/fuzzy/periode/{{$periode->id}}/skpd/{{$skpd->id}}/masukkanpegawai" type="button"
                        class="btn bg-gradient-blue btn-sm">
                        MASUKKAN PEGAWAI</a>
                    <a href="/skpd" type="button" class="btn bg-gradient-blue btn-sm">
                        FUZZIFIKASI</a>
                    <a href="/skpd" type="button" class="btn bg-gradient-blue btn-sm">
                        INFERENSI</a>
                    <a href="/skpd" type="button" class="btn bg-gradient-blue btn-sm">
                        DEFUZZIFIKASI</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div>
                <div class="alert alert-default alert-dismissible text-sm">
                    <table width=100%>
                        <tr>
                            <td valign="top" width=30%>
                                Informasi :<br />
                                Bulan : {{convertBulan($periode->bulan)}} {{$periode->tahun}}<br />
                                SKPD : {{$skpd->nama}}<br /><br />
                                Keterangan :<br />
                                JA = Jumlah Aktivitas<br />
                                MA = Menit Aktivitas<br />
                                K = Kehadiran<br />
                            </td>
                            <td valign="top">
                                Rule Dari BKD :<br />
                                Jumlah Aktivitas Sedikit, Menit Aktivitas Sedikit, Kehadiran Sedikit, Maka Tidak
                                Rajin<br />
                                Jumlah Aktivitas Sedikit, Menit Aktivitas Sedikit, Kehadiran Banyak, Maka Tidak
                                Rajin<br />
                                Jumlah Aktivitas Sedikit, Menit Aktivitas Banyak, Kehadiran Sedikit, Maka Tidak
                                Rajin<br />
                                Jumlah Aktivitas Sedikit, Menit Aktivitas Banyak, Kehadiran Banyak, Maka
                                Rajin<br />
                                Jumlah Aktivitas Banyak, Menit Aktivitas Sedikit, Kehadiran Sedikit, Maka Tidak
                                Rajin<br />
                                Jumlah Aktivitas Banyak, Menit Aktivitas Sedikit, Kehadiran Banyak, Maka
                                Rajin<br />
                                Jumlah Aktivitas Banyak, Menit Aktivitas Banyak, Kehadiran Sedikit, Maka
                                Rajin<br />
                                Jumlah Aktivitas Banyak, Menit Aktivitas Banyak, Kehadiran Banyak, Maka
                                Rajin<br />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-body table-responsive p-2">

                <table class="table table-bordered text-nowrap table-striped table-sm">
                    <thead>
                        <tr style="border:1px solid silver; font-size:10px; font-family:Arial, Helvetica, sans-serif;
                            background-color:antiquewhite" class="text-center">
                            <th rowspan=2>No</th>
                            <th rowspan=2>NIP DAN NAMA</th>
                            <th colspan=3>PARAMETER</th>
                            <th colspan=6>FUZZIFIKASI</th>
                            <th colspan=16>INFERENSI</th>
                            <th rowspan=2>DEFUZZIFIKASI</th>
                            <th rowspan=2>KEPUTUSAN</th>
                            <th rowspan=2>AKSI</th>
                        </tr>
                        <tr style="border:1px solid silver; font-size:10px; font-family:Arial, Helvetica, sans-serif; background-color:antiquewhite"
                            class="text-center">

                            <th>JA</th>
                            <th>MA</th>
                            <th>K</th>
                            <th>JA<br />Sedikit</th>
                            <th>JA<br />Banyak</th>
                            <th>MA<br />Sedikit</th>
                            <th>MA<br />Banyak</th>
                            <th>K<br />Sedikit</th>
                            <th>K<br />Banyak</th>
                            <th>S S S</th>
                            <th>S S B</th>
                            <th>S B S</th>
                            <th>S B B</th>
                            <th>B S S</th>
                            <th>B S B</th>
                            <th>B B S</th>
                            <th>B B B</th>
                            <th>Rule 1</th>
                            <th>Rule 2</th>
                            <th>Rule 3</th>
                            <th>Rule 4</th>
                            <th>Rule 5</th>
                            <th>Rule 6</th>
                            <th>Rule 7</th>
                            <th>Rule 8</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr style="font-size:10px; font-family:Arial, Helvetica, sans-serif;">
                            <td>{{$no++}}</td>
                            <td>{{$item->nip}}<br />{{$item->nama}}</td>
                            <td>{{$item->ja}}</td>
                            <td>{{$item->ma}}</td>
                            <td>{{$item->k}}</td>
                            <td>{{$item->f_ja_s}}</td>
                            <td>{{$item->f_ja_b}}</td>
                            <td>{{$item->f_ma_s}}</td>
                            <td>{{$item->f_ma_b}}</td>
                            <td>{{$item->f_k_s}}</td>
                            <td>{{$item->f_k_b}}</td>
                            <td>{{$item->sss}}</td>
                            <td>{{$item->ssb}}</td>
                            <td>{{$item->sbs}}</td>
                            <td>{{$item->sbb}}</td>
                            <td>{{$item->bss}}</td>
                            <td>{{$item->bsb}}</td>
                            <td>{{$item->bbs}}</td>
                            <td>{{$item->bbb}}</td>
                            <td>{{$item->r1}}</td>
                            <td>{{$item->r2}}</td>
                            <td>{{$item->r3}}</td>
                            <td>{{$item->r4}}</td>
                            <td>{{$item->r5}}</td>
                            <td>{{$item->r6}}</td>
                            <td>{{$item->r7}}</td>
                            <td>{{$item->r8}}</td>
                            <td>{{$item->defuzzy}}</td>
                            <td>{{$item->keputusan}}</td>
                            <td>
                                <a href="/fuzzy/aktivitas/{{$item->nip}}/{{$periode->bulan}}/{{$periode->tahun}}"
                                    class="btn btn-xs btn-primary">Tarik Parameter</a>
                                <a href="/fuzzifikasi/{{$item->id}}" class="btn btn-xs btn-primary">Fuzzifikasi</a>
                                <a href="/inferensi/{{$item->id}}" class="btn btn-xs btn-primary">Inferensi</a>
                                <a href="/defuzzifikasi/{{$item->id}}" class="btn btn-xs btn-primary">DeFuzzifikasi</a>
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
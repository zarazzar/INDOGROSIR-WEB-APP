@extends('layout.main')
@section('pagetitle', 'Pegawai')
@section('hoverpegawai','active')

@section('search')
<form method="GET">
    <div class="input-group input-group-sm" id="input-group-search">
      <input type="text" name="search" class="form-control" placeholder="Cari Pegawai ..." />
    </div>
  </form>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <div class="card">

            <div class="card-body">

                        @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success')}}
                        </div>
                        @endif
                        <h1 class="mt-5 mb-5">Daftar Pegawai PT. INDOMARCO PRISMATAMA PALEMBANG</h1>
                        @if (Auth::user()->role ==='A')
                            <a href="{{route('pegawai.create')}}" class="btn btn-primary btn-rounded mb-5"><i class="mdi mdi-plus-circle-outline"></i> Tambah Pegawai</a>
                        @endif
                        <div class="table-responsive">
                            <table id="example2" class="table  table-hover table-product table-paginate table-strip">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Kode Pegawai</th>
                                        <th>Nama Pegawai</th>
                                        <th>Divisi</th>
                                        <th>Shift</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telp</th>
                                        <th>Tanggal Masuk</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $item)
                                    <tr>
                                        <td class="text-center"><img src="{{asset('storage/'.$item->foto_pegawai)}}" alt="foto" width="50" height="50"></td>
                                        <td>{{$item -> kode_pegawai}}</td>
                                        <td>{{$item -> nama_pegawai}}</td>
                                        <td>{{$item -> divisi -> nama_divisi}}</td>
                                        <td>{{$item -> shift -> waktu_shift}}</td>
                                        <td>{{$item -> alamat}}</td>
                                        <td>{{$item -> nomor_hp}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY')}}</td>
                                        <td>
                                             <div class="d-flex justify-content-end">
                                                    <a href="{{route ('pegawai.edit',$item->id)}}"><button class="btn btn-success btn-sm mx-3"><i class="mdi mdi-square-edit-outline"></i> Edit</button></a>


                                                    <form class="delete-form" data-route="{{route('pegawai.destroy',$item->id)}}" method="POST" >
                                                        @method('delete')
                                                        @csrf
                                                        @can('delete',$item)

                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i>  Delete</button>
                                                        @endcan
                                                    </form>
                                                </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-4">
                                {{$pegawai -> withQueryString()->links('pagination::bootstrap-5')}}
                            </div> --}}
                        </div>
                </div>
</div>

    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                "lengthChange": false,
                "pageLength": 6,
            });
        });
    </script>

@endsection

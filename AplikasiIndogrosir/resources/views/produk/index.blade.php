@extends('layout.main')
@section('pagetitle', 'Produk')
@section('hoverproduk','active')
@section('search')
    <form method="GET">
        <div class="input-group input-group-sm" id="input-group-search">
        <input type="text" name="search" class="form-control" placeholder="Cari Produk ..." />
        </div>
    </form>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
            <div class="card-body">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <h4 class="card-title">Produk</h4>
            @if (Auth::user()->role ==='A')
                <a href="{{ route('produk.create')}}" class="btn btn-primary mb-5"><i class="mdi mdi-plus-circle-outline"></i> Tambah</a>
            @endif
                <div class="row d-flex justify-content-center">
                    @foreach ($produk as $item)
                        <div class="card  shadow mb-3 mx-5" style="max-width: 540px;">
                            <div class="row g-0 ">
                                <div class="col-md-4">
                                    <img width="240" height="240"  src="{{ $item->foto_produk ? asset('storage/' . $item->foto_produk) : asset('images/faces/face5.jpg') }}">
                                </div>
                                <div class="col-md-8 ">
                                    <div class="card-body ml-7">
                                        <div class="mb-2">
                                            <h5 class="card-title text-primary">{{$item -> nama_produk}}</h5>
                                            <p class="card-text">Brand {{$item -> brand -> nama_brand}}</p>
                                            <p class="card-text">{{$item -> kontainerbarang -> nama_kontainer}}</p>
                                            <p class="card-text text-success">Harga {{$item -> harga_produk}}</p>
                                            <p class="card-text">Stok {{$item -> stok_produk}}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            @can('update',$item)

                                            <a href="{{route('produk.edit', $item->id)}}"><button class="btn btn-success btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button></a>
                                            @endcan
                                            <form method="post" class="delete-form"
                                                data-route="{{ route('produk.destroy', $item->id) }}">
                                                @method('delete')
                                                @csrf
                                                @can('delete',$item)

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{$produk -> withQueryString()->links('pagination::bootstrap-5')}}
                </div>
        </div>
    </div>

@endsection

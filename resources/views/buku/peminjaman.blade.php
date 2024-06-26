@extends('layouts.perpus')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body bg-white">
                    <h1 class="h3 font-weight-bold mb-4">Data Peminjaman</h1>
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif


                    <div class="mb-4 d-flex justify-content-between">
                        <a href="{{ route('peminjaman.tambah') }}" class="btn btn-info">
                            + Tambah Data Peminjaman
                        </a>
                        <a href="{{ route('print') }}" class="btn btn-info">
                            <i class="fa fa-download"></i>Ekspor PDF</a>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Peminjam</th>
                                <th>Buku yang Dipinjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Seharusnya Kembali</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $p)
                            <tr>
                            <td class="px-4 py-2">{{ $p->user->name }}</td>
                            <td class="px-4 py-2">{{ $p->buku->judul }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d-M-Y') }}</td>
                            <td class="px-4 py-2">{{ $p->tanggal_pengembalian ? \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d-M-Y') : 'Belum Dikembalikan' }}</td>
                            <td class="px-4 py-2">{{ $p->denda ? \Carbon\Carbon::parse($p->denda)->format('d-M-Y') : '' }}</td>

                                <td class="px-4 py-2 border">
                                    @if($p->status === 'Dipinjam')
                                    <span class="badge bg-warning">{{$p->status}}</span>
                                    @elseif($p->status === 'Dikembalikan')
                                    <span class="badge bg-success">{{$p->status}}</span>
                                    @elseif($p->status === 'Denda')
                                    <span class="badge bg-danger">{{$p->status}}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    @if($p->status === 'Dipinjam')
                                    <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Kembalikan
                                        </button>
                                        @elseif ($p->status === 'Denda')
                                                    <a href="{{route('peminjaman.denda', $p->id)}}" class="btn btn-danger">
                                                        Bayar Denda
                                                    </a>
                                                @else ($p->status === 'Dikembalikan')
                                   
                                    -
                                    @endif
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 border text-center">Tidak ada data buku.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
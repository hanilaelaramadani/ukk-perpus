@extends('layouts.perpus')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="mb-4">
                            <a href="{{ route('users.create') }}" class="btn btn-info">
                                + Tambah Pengguna
                            </a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr>
                                        <td>{{ $u->id }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>
                                   
                                        @foreach ($u->roles as $role)
                                        {{$role->name}}
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2">
                                    <form method="post" action="{{route('users.destroy', $u->id)}}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-warning">
                                        <i class="fa fa-trash"></i>    
                                        Hapus</button>

                                

                                    <a class="btn btn-danger" href="{{ route('users.edit', $u->id) }}">Edit</a>
                                    </td>
                                    </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
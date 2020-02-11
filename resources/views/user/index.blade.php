@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')
    <div class="container my-5">
        <nav class="breadcrumb mb-5">
            <a class="breadcrumb-item" href="{{ route("user.index") }}">
                {{ config("app.name") }}
            </a>
            <a class="breadcrumb-item active">
                Manajemen User
            </a>
        </nav>

        <h1 class='mb-5'>
            <i class="fa fa-users" aria-hidden="true"></i>
            Manajemen User
        </h1>

        <div class="d-flex justify-content-end my-4">
            <a class="btn btn-outline-dark" href="{{ route("user.create") }}">
                Tambah User
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
            </a>
        </div>


        @include('layouts.messages')

        <table class="table">
            <thead>
            <tr>
                <th> No. </th>
                <th> Nama </th>
                <th> Nama Pengguna </th>
                <th> Level </th>
                <th class="text-center"> Manajemen </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->username }} </td>
                    <td> {{ \App\Constants\UserLevel::LEVELS[$user->level] ?? "-" }} </td>
                    <td class="text-center">
                        <a class="btn btn-outline-dark" href="{{ route("user.edit", $user) }}">
                            Ubah
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>

                        <form class="d-inline-block" action="{{ route("user.destroy", $user) }}" method="POST">
                            @csrf
                            @method("DELETE")

                            <button class="btn btn-outline-danger" type="submit">
                                Hapus
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

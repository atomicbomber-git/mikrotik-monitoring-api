@extends('layouts.app')
@section('title', 'Ubah User')
@section('content')
    <div class="container my-5">
        <nav class="breadcrumb mb-5">
            <a class="breadcrumb-item" href="{{ route("user.index") }}">
                {{ config("app.name") }}
            </a>
            <a class="breadcrumb-item" href="{{ route("user.index") }}">
                Manajemen User
            </a>
            <span class="breadcrumb-item active">
                Ubah User '{{ $user->username }}'
            </span>
        </nav>

        <h1 class='mb-5'>
            <i class="fa fa-pencil" aria-hidden="true"></i>
            Ubah User
        </h1>

        @include('layouts.messages')

        <form action="{{ route("user.update", $user) }}" method="post">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="username"> Username:</label>
                <input
                        id="username"
                        type="text"
                        placeholder="Username"
                        class="form-control {{ $errors->has("username") ? "is-invalid" : "" }}"
                        name="username"
                        value="{{ old("username", $user->username) }}"
                />
                @foreach($errors->get("username") ?? [] as $feedback)
                    <span class="invalid-feedback">
                {{ $feedback }}
            </span>
                @endforeach
            </div>

            <div class="form-group">
                <label for="name"> Nama:</label>
                <input
                        id="name"
                        type="text"
                        placeholder="Nama"
                        class="form-control {{ $errors->has("name") ? "is-invalid" : "" }}"
                        name="name"
                        value="{{ old("name", $user->name) }}"
                />
                @foreach($errors->get("name") ?? [] as $feedback)
                    <span class="invalid-feedback">
                {{ $feedback }}
            </span>
                @endforeach
            </div>

            <div class="form-group">
                <label for="password"> Password:</label>
                <input
                        id="password"
                        type="text"
                        placeholder="Password"
                        class="form-control {{ $errors->has("password") ? "is-invalid" : "" }}"
                        name="password"
                        value="{{ old("password") }}"
                />
                @foreach($errors->get("password") ?? [] as $feedback)
                    <span class="invalid-feedback">
                        {{ $feedback }}
                    </span>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-primary">
                    Ubah User
                </button>
            </div>

        </form>


    </div>
@endsection

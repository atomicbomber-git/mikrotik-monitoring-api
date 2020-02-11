@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="username"> Username:</label>
                                <input
                                        id="username"
                                        type="text"
                                        placeholder="Username"
                                        class="form-control {{ $errors->has("username") ? "is-invalid" : "" }}"
                                        name="username"
                                        value="{{ old("username") }}"
                                />
                                @foreach($errors->get("username") ?? [] as $feedback)
                                    <span class="invalid-feedback">
                                    {{ $feedback }}
                                </span>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="password"> Password:</label>
                                <input
                                        id="password"
                                        type="password"
                                        placeholder="Password"
                                        name="password"
                                        class="form-control {{ $errors->has("password") ? "is-invalid" : "" }}"
                                />
                                @foreach($errors->get("username") ?? [] as $feedback)
                                    <span class="invalid-feedback">
                                        {{ $feedback }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Log In
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

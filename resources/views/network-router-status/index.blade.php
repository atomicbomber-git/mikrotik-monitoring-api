@extends('layouts.app')
@section('title', 'Status Router')
@section('content')
<div class="container my-5">
    <h1 class='mb-5'>
        <i class='fa fa-list-alt'></i>
        Status Router
    </h1>

    @foreach ($network_routers as $network_router)
    <div class="card">
        <div class="card-body">
            <h2 class="h5">
                {{ $network_router->name }}
            </h2>

            <hr>

            <dl>
                <dt> Alamat IP </dt>
                <dd> {{ $network_router->ipv4_address }} </dd>

                <dt> Status </dt>
                <dd>
                    @if ($network_router->isConnected)

                    <span class="badge badge-success">
                        Terhubung
                    </span>

                    @else

                    <span class="badge badge-danger">
                        Tidak terhubung
                    </span>

                    @endif
                </dd>
            </dl>
        </div>
    </div>
    @endforeach
</div>
@endsection

@foreach(session("messages") ?? [] as $message)
    <div class="alert alert-{{ $message["state"] ?? "info" }}">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        {{ $message["content"] ?? "" }}
    </div>
@endforeach
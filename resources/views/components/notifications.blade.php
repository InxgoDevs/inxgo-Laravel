<div>
    @foreach ($notifications as $notification)
        <div class="notification">
            {{ $notification->message }}
        </div>
    @endforeach
</div>
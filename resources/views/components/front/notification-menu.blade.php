<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
        <i class="fas fa-bell"></i>
        <span id="notificationCount" class="badge bg-danger" style="display: {{ $newCount > 0 ? 'inline-block' : 'none' }};">
            {{ $newCount }}
        </span>
    </a>
    <ul id="notificationList" class="dropdown-menu dropdown-menu-end">
        @foreach($notifications as $notification)
            <li>
                <a class="dropdown-item" href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}">
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    <small>{{ $notification->data['message'] }}</small>
                    <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }} </span>
                </a>
            </li>
        @endforeach
    </ul>
</li>

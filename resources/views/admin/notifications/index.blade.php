@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notifications</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" id="markAllRead">
                            Mark All as Read
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="notification-list">
                            @foreach($notifications as $notification)
                                <div class="notification-item border-bottom p-3 {{ $notification->is_read ? 'bg-light' : 'bg-white' }}" data-id="{{ $notification->id }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 {{ $notification->is_read ? 'text-muted' : 'font-weight-bold' }}">
                                                {{ $notification->title }}
                                            </h6>
                                            <p class="mb-1 text-muted">{{ $notification->message }}</p>
                                            <small class="text-muted">
                                                {{ $notification->created_at->diffForHumans() }}
                                                @if($notification->data && isset($notification->data['performed_by_name']))
                                                    • by {{ $notification->data['performed_by_name'] }}
                                                @endif
                                            </small>
                                        </div>
                                        <div class="ml-3">
                                            @if(!$notification->is_read)
                                                <button class="btn btn-sm btn-outline-primary mark-read" data-id="{{ $notification->id }}">
                                                    Mark Read
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-outline-danger delete-notification" data-id="{{ $notification->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No notifications</h5>
                            <p class="text-muted">You're all caught up!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark single notification as read
    document.querySelectorAll('.mark-read').forEach(button => {
        button.addEventListener('click', function() {
            const notificationId = this.dataset.id;
            markAsRead(notificationId);
        });
    });

    // Mark all as read
    document.getElementById('markAllRead').addEventListener('click', function() {
        markAllAsRead();
    });

    // Delete notification
    document.querySelectorAll('.delete-notification').forEach(button => {
        button.addEventListener('click', function() {
            const notificationId = this.dataset.id;
            deleteNotification(notificationId);
        });
    });

    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
                notificationItem.classList.add('bg-light');
                notificationItem.classList.remove('bg-white');
                
                const title = notificationItem.querySelector('h6');
                title.classList.add('text-muted');
                title.classList.remove('font-weight-bold');
                
                const markReadBtn = notificationItem.querySelector('.mark-read');
                if (markReadBtn) {
                    markReadBtn.remove();
                }
                
                updateNotificationCount();
            }
        });
    }

    function markAllAsRead() {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.notification-item').forEach(item => {
                    item.classList.add('bg-light');
                    item.classList.remove('bg-white');
                    
                    const title = item.querySelector('h6');
                    title.classList.add('text-muted');
                    title.classList.remove('font-weight-bold');
                    
                    const markReadBtn = item.querySelector('.mark-read');
                    if (markReadBtn) {
                        markReadBtn.remove();
                    }
                });
                
                updateNotificationCount();
            }
        });
    }

    function deleteNotification(notificationId) {
        if (confirm('Are you sure you want to delete this notification?')) {
            fetch(`/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
                    notificationItem.remove();
                    updateNotificationCount();
                }
            });
        }
    }

    function updateNotificationCount() {
        fetch('/notifications/count')
        .then(response => response.json())
        .then(data => {
            // Update notification count in navbar if it exists
            const countElement = document.querySelector('.notification-count');
            if (countElement) {
                if (data.count > 0) {
                    countElement.textContent = data.count;
                    countElement.style.display = 'inline';
                } else {
                    countElement.style.display = 'none';
                }
            }
        });
    }
});
</script>
@endsection 
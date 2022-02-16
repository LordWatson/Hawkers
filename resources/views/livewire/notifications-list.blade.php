<div class="col-md-8">
    <button id="markAllAsRead" wire:click="markAllAsRead()" style="display: none;"></button>
    @foreach($notifs as $notification)
        <div class="row justify-content-center @if(isset($notification->read_at)) notificaiton-row-read @else notificaiton-row @endif">
            <div class="col-md-2 border-right date text-center"><small>{{ date_format($notification->created_at, 'd, M Y') }}</small></div>
            <div class="col-md-8 border-right msg text-center">{{ $notification->data['message'] }}</div>
            <div class="col-md-2 read text-center">
                @if(!isset($notification->read_at))
                    <span wire:click="markAsRead('{{ $notification->id }}')" class="fake-link"><span>Mark as read</span></span>
                @else
                    <span wire:click="markAsUnread('{{ $notification->id }}')" class="fake-link"><span>Mark as unread</span></span>
                @endif
            </div>
        </div>
    @endforeach
</div>

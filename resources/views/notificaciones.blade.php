{{-- <div class="container">
    <div class="notifications mt-4">
        <h2 style="font-size: 18px">Notificaciones</h2>
        @if($notifications->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay notificaciones
            </div>
        @else
            <div class="list-group">
                @foreach ($notifications as $notification)
                    <a href="{{ route('tickets.manage', $notification->data['ticket_id']) }}" class="list-group-item list-group-item-action"
                        style="background-color: {{ $notification->read_at ? '#f8f9fa' : '#2fd8c64a' }}; color: {{ $notification->read_at ? '#838383' : '#0087ff' }};">
                        <div>
                            <h5 class="mb-1">
                                {{ $notification->data['employee_name'] }} ha creado un nuevo ticket de prioridad {{ $notification->data['priority_name'] }}
                            </h5>
                            <p class="mb-1">{{ $notification->data['created_at'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div> --}}

{{-- @if($ticket->state_clock == 'CORRIENDO')
    <button id="clockHour" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $hoursClock }}
    </button>
    <button id="clockMinute" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $minutesClock }}
    </button>
    <button id="clockSecond" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $secondsClock }}
    </button>
    <p id="fulltime" class="fulltime"> </p>
@else
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $hoursClock }}
    </button>
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $minutesClock }}
    </button>
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ $secondsClock }}
    </button>
@endif --}}

@if($ticket->state_clock == 'CORRIENDO')
    <button id="clockHour" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($hoursClock, 2, '0', STR_PAD_LEFT) }}
    </button>
    <button id="clockMinute" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($minutesClock, 2, '0', STR_PAD_LEFT) }}
    </button>
    <button id="clockSecond" class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($secondsClock, 2, '0', STR_PAD_LEFT) }}
    </button>
    <p id="fulltime" class="fulltime"> </p>
@else
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($hoursClock, 2, '0', STR_PAD_LEFT) }}
    </button>
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($minutesClock, 2, '0', STR_PAD_LEFT) }}
    </button>
    <button class="bg bg-primary text-center w-20" style="font-size: 20px">
        {{ str_pad($secondsClock, 2, '0', STR_PAD_LEFT) }}
    </button>
@endif

@if($ticket->state_clock == 'CORRIENDO')
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
@endif

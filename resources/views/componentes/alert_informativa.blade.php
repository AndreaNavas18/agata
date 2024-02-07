@if ($tipo == 'success')
    <div class="alert alert-success shadow-sm">
		<i class="fas fa-check-circle"></i>
        {{ $mensaje }}

        @if (isset($close) && $close)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<i class="fas fa-times"></i>
      		</button>
        @endif
    </div>
@endif

@if ($tipo == 'info')
    <div class="alert alert-info shadow-sm {{ isset($clases) ? $clases : '' }}">
		<i class="fas fa-info-circle"></i>
        {{ $mensaje }}
        @if (isset($close) && $close)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<i class="fas fa-times"></i>
      		</button>
        @endif
    </div>
@endif

@if ($tipo == 'warning')
    <div class="alert alert-warning shadow-sm">
        <i class="fas fa-exclamation-circle"></i>
        {{ $mensaje }}

        @if (isset($close) && $close)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
@endif

@if ($tipo == 'danger')
    <div class="alert alert-danger shadow-sm">
		<i class="fas fa-exclamation-triangle"></i>
        {{ $mensaje }}

        @if (isset($close) && $close)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        		<i class="fas fa-times"></i>
      		</button>
        @endif
    </div>
@endif

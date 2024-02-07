@if (session('success'))
    <div class="alert alert-success notificacion alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @php
        $flag = true;
    @endphp

@endif

@if (session('info'))
    <div class="alert alert-info notificacion alert-dismissible fade show" role="alert">
		<i class="fas fa-info-circle"></i>
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @php
        $flag = true;
    @endphp
@endif

@if (session('warning'))
    <div class="alert alert-warning notificacion alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @php
        $flag = true;
    @endphp
@endif

@if (session('error'))
    <div class="alert alert-danger notificacion alert-dismissible fade show" role="alert">
		<i class="fas fa-exclamation-triangle"></i>
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @php
        $flag = true;
    @endphp
@endif

@if ($errors->any())
    <div class="alert alert-warning notificacion alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Error
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @php
        $flag = true;
    @endphp
@endif

@if (isset($flag) && $flag)
	@push ('script')
	<script>
		$(function() {
			setTimeout(function() {
				$('div.notificacion').hide('slow');
            }, 20000);
		});
	</script>
	@endpush
@endif

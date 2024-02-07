<!-- page-header -->
@if(isset($breadcrumb))
    <div class="page-header">
        @if(!isset($dataBreadcrumb))
            @php
                $dataBreadcrumb = array();
            @endphp
        @endif
        {{ Breadcrumbs::render($breadcrumb, $dataBreadcrumb) }}
    </div>
@endif
<!-- End page-header -->

<div class="card">
    <div class="card-header">
        @isset($title)
            <h4 class="card-title">{{ $title }}</h4>
        @endisset
    </div>
    <div class="card-body">
        @isset($header)
            {{ $header }}
        @endisset
        <div>{{ $slot }}</div>
    </div>
</div>

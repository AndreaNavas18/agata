<div class="side-app">
    <!-- page-header -->
   <div class="page-header">
        @if(isset($breadcrumb))
            @if(!isset($dataBreadcrumb))
                @php
                    $dataBreadcrumb = array();
                @endphp
            @endif
            {{ Breadcrumbs::render($breadcrumb, $dataBreadcrumb) }}
        @endif
   </div>
</div>

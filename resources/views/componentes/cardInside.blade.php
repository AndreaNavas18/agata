<div class="card">
    <div class="card-body">
        {{ $title }}

        @isset($content)
            {{ $content }}
        @endisset
    </div>
</div>

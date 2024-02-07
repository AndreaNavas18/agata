<label class="form-label" for="{{ isset($id) ? $id : ''}}">
    {{ $title }}
    @if(isset($required) && $required)
        <i class=" fa fa-asterisk small text-danger"></i>
    @endif
</label>

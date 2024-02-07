<div class="input-group">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
        </div>
    </div>
    <input class="form-control fecha"
    placeholder="YYYY/MM/DD"
    name="{{$name}}"
    id="{{$name}}"
    value="{{ isset($value) ? $value : ''}}"
    {{isset($required) && $required ? 'required' : ''}}
    type="text">
</div>

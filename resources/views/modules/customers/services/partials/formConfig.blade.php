<div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Ip',
                'required' => false])
            @endcomponent
            <input type="text"
                name="ip"
                id="ip"
                value="{{ $service->ip ? $service->ip : '' }}"
                class="form-control"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Vlan',
                'required' => false])
            @endcomponent
            <input type="text"
                name="vlan"
                id="vlan"
                value="{{ $service->vlan ? $service->vlan : '' }}"
                class="form-control">
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Mascara',
                'required' => false])
            @endcomponent
            <input type="text"
                name="mascara"
                id="mascara"
                class="form-control"
                value="{{ $service->mascara ? $service->mascara : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Gateway',
                'required' => false])
            @endcomponent
            <input type="text"
                name="gateway"
                id="gateway"
                class="form-control"
                value="{{ $service->gateway ? $service->gateway : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Mac',
                'required' => false])
            @endcomponent
            <input type="text"
                name="mac"
                id="mac"
                class="form-control"
                value="{{ $service->mac ? $service->mac : '' }}"
                >
        </div>
        
        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Ancho de banda',
                'required' => false])
            @endcomponent
            <select class="form-control selectpicker"
                name="ancho_de_banda"
                id="ancho_de_banda"
                >
                <option value="">--Seleccione--</option>
                @foreach($anchosDeBanda as $anchodeBandaKey => $anchodeBandaRow)
                    <option value="{{ $anchodeBandaKey }}" {{ ($anchodeBandaKey == $service->ancho_de_banda) ? 'selected' : '' }}>
                        {{ $anchodeBandaRow }}
                    </option>
                @endforeach
                    {{-- @foreach($anchosDeBanda as $anchodeBandaKey => $anchodeBandaRow)
                        <option> Key: {{ $anchodeBandaKey }}, Valor: {{ $anchodeBandaRow }}</option>
                    @endforeach --}}
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Ip vpn',
                'required' => false])
            @endcomponent
            <input type="text"
                name="ip_vpn"
                id="ip_vpn"
                class="form-control"
                value="{{ $service->ip_vpn ? $service->ip_vpn : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Tipo vpn',
                'required' => false])
            @endcomponent
            <input type="text"
                name="tipo_vpn"
                id="tipo_vpn"
                class="form-control"
                value="{{ $service->tipo_vpn ? $service->tipo_vpn : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'User vpn',
                'required' => false])
            @endcomponent
            <input type="text"
                name="user_vpn"
                id="user_vpn"
                class="form-control"
                value="{{ $service->user_vpn ? $service->user_vpn : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Password vpn',
                'required' => false])
            @endcomponent
            <input type="text"
                name="password_vpn"
                id="password_vpn"
                class="form-control"
                value="{{ $service->password_vpn ? $service->password_vpn : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'User tunel',
                'required' => false])
            @endcomponent
            <input type="text"
                name="user_tunel"
                id="user_tunel"
                class="form-control"
                value="{{ $service->user_tunel ? $service->user_tunel : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Id tunel',
                'required' => false])
            @endcomponent
            <input type="text"
                name="id_tunel"
                id="id_tunel"
                class="form-control"
                value="{{ $service->id_tunel ? $service->id_tunel : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Tecnología',
                'required' => false])
            @endcomponent
            <select class="form-control selectpicker"
                name="tecnologia"
                id="tecnologia"
                >
                <option value="">--Seleccione--</option>
                @foreach($tecnologias as $tecnologiaKey => $tecnologiaRow)
                    <option value="{{ $tecnologiaKey }}" {{ ($tecnologiaKey == $service->tecnologia) ? 'selected' : '' }}>
                        {{ $tecnologiaRow }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Equipo',
                'required' => false])
            @endcomponent
            <input type="text"
                name="equipo"
                id="equipo"
                class="form-control"
                value="{{ $service->equipo ? $service->equipo : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Modelo',
                'required' => false])
            @endcomponent
            <input type="text"
                name="modelo"
                id="modelo"
                class="form-control"
                value="{{ $service->modelo ? $service->modelo : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Serial',
                'required' => false])
            @endcomponent
            <input type="text"
                name="serial"
                id="serial"
                class="form-control"
                value="{{ $service->serial ? $service->serial : '' }}"
                >
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Activo fijo',
                'required' => false])
            @endcomponent
            <input type="text"
                name="activo_fijo"
                id="activo_fijo"
                class="form-control"
                value="{{ $service->activo_fijo ? $service->activo_fijo : '' }}"
                >
        </div>

        <div class="col-12 mb-4">
            @component('componentes.label', [
                'title' => 'Documentos',
                'id' => 'files[]',
                'required' => false])
            @endcomponent
            <input type="file"
                class="form-control"
                name="files[]"
                id="files"
                multiple>
        </div>
                
</div>

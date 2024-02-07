<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable {{ isset($size) ? $size : '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                @if(isset($btnCancel))
                    <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                @endif
                {{ isset($footer) ? $footer : '' }}
            </div>
        </div>
    </div>
</div>

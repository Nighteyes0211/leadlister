<div>

    <button class="d-none" type="button" id="{{ $modalId }}-opener" data-bs-toggle="modal"
        data-bs-target="#{{ $modalId }}">Confirm delete</button>

    <div wire:ignore.self class="modal fade" id="{{ $modalId }}">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body text-center p-4">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                    <i class="fe fe-x-circle fs-80 text-danger lh-1 mb-5 d-inline-block"></i>
                    <h4 class="text-danger">Are you sure you want to delete it?</h4>
                    <button aria-label="Close" class="btn btn-danger pd-x-25" wire:click="confirmed">Continue</button>
                </div>
            </div>
        </div>
    </div>

</div>

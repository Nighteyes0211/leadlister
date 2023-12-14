@props(['file'])
<div class="d-flex justify-content-between align-items-center" style="max-width: 100%">
    <div class="me-2">
        <i class="fa fa-file"></i>
        <span class="text-truncate">{{ basename($file) }}</span>
    </div>

    @if (!($file == "N\A" || $file == "N/A"))

        <div>
            <a class="btn btn-secondary btn-small mr-2" href="{{ asset($file) }}" target="_blank" class="text-decoration-none">
                <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-secondary btn-small" href="{{ asset($file) }}" download class="text-decoration-none">
                <i class="fa fa-download"></i>
            </a>
        </div>
    @endif
</div>

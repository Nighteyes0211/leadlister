@props(['label', 'value', 'icon', 'iconBg' => 'success'])
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <div class="mt-0 text-start">
                    <span class="fs-14 font-weight-semibold">{{ $label }}</span>
                    <h3 class="mb-0 mt-1 mb-2">{{ $value }}</h3>
                </div>
            </div>
            <div class="col-4">
                <div class="icon1 bg-{{ $iconBg }} my-auto float-end">
                    <i class="{{ $icon }}"></i>
                </div>
            </div>
        </div>
        <div class="mt-3">
            {{ $slot }}
        </div>
    </div>
</div>

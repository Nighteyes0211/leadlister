@props(['id', 'title', 'parent', 'open' => false])

<div class="card">
    <div class="card-header" id="{{ $id }}heading">
        <div class="d-flex justify-content-between w-100">
            <h5 class="mb-0">

                <button class="btn btn-link {{ !$open ? 'collapsed' : '' }}" type="button" data-toggle="collapse"
                    data-target="#{{ $id }}collapse" aria-expanded="{{ $open ? true : false }}"
                    aria-controls="{{ $id }}collapse">
                    {{ $title }}
                </button>



            </h5>
            <div>
                @if (isset($action))
                    {{ $action }}
                @endif
            </div>
        </div>

    </div>

    <div id="{{ $id }}collapse" class="collapse {{ $open ? 'show' : '' }}"
        aria-labelledby="{{ $id }}heading" data-parent="#{{ $parent }}">
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>

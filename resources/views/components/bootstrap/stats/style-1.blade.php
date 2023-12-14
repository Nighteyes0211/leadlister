@props(['label', 'value'])
<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-8">

                <div class="mt-0 text-start">
                    <span class="fs-16 font-weight-semibold">{{ $label }}</span>
                    <h3 class="mb-0 mt-1 text-success fs-25">
                        {{ $value }}</h3>
                </div>


            </div>
            <div class="col-4">
                <div
                    class="icon1 bg-primary-transparent my-auto float-end available-seat seat-area">
                    @isset($icon)
                        {{ $icon }}
                    @endisset
                </div>
            </div>
        </div>
    </div>


</div>

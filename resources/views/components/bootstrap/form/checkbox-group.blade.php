@props(['label', 'col' => true])



<x-bootstrap.form.group :col="$col">
    @if (isset($label))
        <label class="{{ !$col ? '' : 'text-md-right col-12 col-md-3 col-lg-3' }}">{{ $label }}</label>
    @endif
    @if ($col)
        <div class="col-sm-12 col-md-7">
            {{ $slot }}
        </div>
    @else
        <div>
            {{ $slot }}
        </div>
    @endif
</x-bootstrap.form.group>

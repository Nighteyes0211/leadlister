@props(['label', 'name', 'wire' => true, 'col' => true, 'mb' => ''])

@php
    $hasErrors = $errors->any();
    $errorClass = $hasErrors && $errors->has($name) ? 'is-invalid' : '';
@endphp




<x-bootstrap.form.group class="{{ $mb ?: '' }}" :col="$col">



    @if (isset($label))
        <label for="{{ $name }}"
            class="{{ !$col ? '' : 'col-form-label text-md-right col-12 col-md-3 col-lg-3' }}">{{ $label }}</label>
    @endif
    @if ($col)


        <div class="col-sm-12 col-md-7">
            <select id="{{ $name }}" {!! $attributes->merge(['class' => "form-control $errorClass"]) !!} {!! $wire ? "wire:model='$name'" : "name='$name'" !!}>
                @if ($slot->isEmpty())
                    <option disabled>No record</option>
                @else
                    {{ $slot }}
                @endif
            </select>

            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if (isset($append))
                <div class="mt-4">
                    {{ $append }}
                </div>
            @endif

        </div>
    @else
        <select id="{{ $name }}" {!! $attributes->merge(['class' => "form-control $errorClass"]) !!} {!! $wire ? "wire:model='$name'" : "name='$name'" !!}>
            @if ($slot->isEmpty())
                <option disabled>No record</option>
            @else
                {{ $slot }}
            @endif
        </select>


        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if (isset($append))
            <div class="mt-4">
                {{ $append }}
            </div>
        @endif
    @endif

</x-bootstrap.form.group>

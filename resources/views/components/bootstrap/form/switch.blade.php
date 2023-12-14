@props(['label', 'name', 'wire' => true, 'col' => true, 'showerror' => true, 'mb' => ''])

@php
    $hasErrors = $errors->any();
    $errorClass = $hasErrors && $errors->has($name) ? 'is-invalid' : '';
@endphp


<x-bootstrap.form.group class="{{ $mb ?: '' }}" :col="$col">

    @if ($col)
        <div class="col-sm-12 col-md-7">

            <div class="form-check form-switch">
                @if (isset($label))
                    <label for="{{ $name }}"
                        class="{{ !$col ? 'form-check-input' : 'form-check-input col-form-label text-md-right col-12 col-md-3 col-lg-3' }}">{{ $label }}</label>
                @endif
                <input {!! $attributes->merge(['class' => "form-check-input $errorClass"]) !!} type="checkbox" role="switch" {!! $wire ? "wire:model='$name'" : "name='$name'" !!}>
            </div>

            @if ($showerror)
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            @endif
            @if ($slot->isNotEmpty())
                <div class="mt-0"> {{ $slot }} </div>
            @endif
        </div>
    @else
        <input {!! $attributes->merge(['class' => "form-check-input $errorClass"]) !!} type="checkbox" role="switch" {!! $wire ? "wire:model='$name'" : "name='$name'" !!}>
        @if ($showerror)
            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        @endif
        @if (isset($slot))
            <div class="mt-0">
                {{ $slot }}
            </div>
        @endif
    @endif
</x-bootstrap.form.group>

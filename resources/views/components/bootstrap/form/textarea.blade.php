@props(['label', 'name', 'type' => 'text', 'wire' => true, 'col' => true, 'showerror' => true, 'mb' => ''])

@php
    $hasErrors = $errors->any();
    $errorClass = $hasErrors && $errors->has($name) ? 'is-invalid' : '';
    $oldValue = !$wire ? old($name) : '';

@endphp


<x-bootstrap.form.group class="{{ $mb?:'' }}" :col="$col">
    @if (isset($label))
        <label for="{{ $name }}"
            class="{{ !$col ? '' : 'col-form-label text-md-right col-12 col-md-3 col-lg-3' }}">{{ $label }}</label>
    @endif
    @if ($col)
        <div class="col-sm-12 col-md-7">
            <textarea type="{{ $type }}" {!! $attributes->merge(['class' => "form-control $errorClass"]) !!} {!! $wire ? "wire:model.defer='$name'" : "name='$name' value='$oldValue'" !!} ></textarea>
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
        <textarea type="{{ $type }}" {!! $attributes->merge(['class' => "form-control $errorClass"]) !!} {!! $wire ? "wire:model.defer='$name'" : "name='$name' value='$oldValue'" !!} ></textarea>
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

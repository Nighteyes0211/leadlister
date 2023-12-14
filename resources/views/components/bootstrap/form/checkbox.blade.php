@props(['label', 'name', 'wire' => true, 'col' => true, 'mb' => 'mb-3', 'showerror' => true, 'disabled' => false])

@php
    $hasErrors = $errors->any();
    $errorClass = $hasErrors && $errors->has($name) ? 'is-invalid' : '';
    $oldValue = !$wire ? old($name) : '';
@endphp

<x-bootstrap.form.group class="d-flex flex-column" :col="$col" mb="{{ $mb }}">
    @if (isset($label))
        <div class="{{ !$col ? 'mb-0' : 'col-form-label text-md-right col-12 col-md-3 col-lg-3' }}"></div>
    @endif
    @if ($col)
        <div class="col-sm-12 col-md-7">

                <input  id="{{ $name }}" {{ $disabled ? "disabled" : '' }} type="checkbox" {!! $attributes->merge(['class' => "w-auto form-check $errorClass"]) !!} {!! $wire ? "wire:model.defer='$name'" : "name='$name'" !!}/>
                @if ($showerror)
                    @error($name)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                @endif
                @if ($slot->isNotEmpty())
                    @dd($slot)
                    <div class="mt-2">
                        {{ $slot }}
                    </div>
                @endif

            <label for="{{ $name }}" class="{{ !$col ? 'mb-0' : 'custom-checkbox custom-control col-form-label text-md-right col-12 col-md-3 col-lg-3' }}">{{ $label }}</label>

        </div>
    @else

        <div class="d-flex align-items-center w-100 justify-content-start">

            <label for="{{ $name }}" class="{{ !$col ? 'mb-0 custom-checkbox custom-control' : ' col-form-label text-md-right col-12 col-md-3 col-lg-3' }}">

                <input id="{{ $name }}" {{ $disabled ? "disabled" : '' }} type="checkbox" {!! $attributes->merge(['class' => "custom-control-input mr-2 $errorClass"]) !!} {!! $wire ? "wire:model.defer='$name'" : "name='$name'" !!} />
                <span class="custom-control-label" for="remember_me">{{ $label }}</span>

            </label>
        </div>

        @if ($showerror)
            @error($name)
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        @endif
        @if (isset($slot))
            <div class="mt-2">
                {{ $slot }}
            </div>
        @endif
    @endif

</x-bootstrap.form.group>

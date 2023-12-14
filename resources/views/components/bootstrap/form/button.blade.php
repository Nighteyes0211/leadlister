@props([
    'class' => '',
    'id' => uniqid(),
    'mb' => '',
    'text',
    'col' => true,
    'action' => 'store',
    'color' => 'primary',
    'size' => 'md',
])



<x-bootstrap.form.group :col="$col" mb="{{ $mb }}">
    @if ($col)
        <div class="col-12 col-md-3 col-lg-3"></div>
        <div class="col-sm-12 col-md-7">
            <button {{ $attributes }} type="submit" id="{{ $id }}"
                class="btn btn-{{ $color }} btn-{{ $size }} btn-block {{ $class }}"
                wire:loading.attr="disabled" {!! $action ? "wire:target='{$action}'" : '' !!}>
                {{ isset($text) ? $text : $slot }} <span wire:loading {!! $action ? "wire:target='{$action}'" : '' !!}>...</span>
            </button>
        </div>
    @else
        <button {{ $attributes }} type="submit" id="{{ $id }}"
            class="d-flex align-items-center btn btn-{{ $color }} btn-{{ $size }} {{ $class }}" wire:loading.attr="disabled"
            {!! $action ? "wire:target='{$action}'" : '' !!}>
            {!! isset($text) ? "<span>$text</span>" : $slot !!} <span class="spinner-border ms-1" role="status" wire:loading
                {!! $action ? "wire:target='{$action}'" : '' !!}> <span class="sr-only">Loading...</span>
            </span>

        </button>
    @endif
</x-bootstrap.form.group>

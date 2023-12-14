@props(['label', 'name', 'wire' => true, 'col' => true, 'mb' => ''])

<div>

    <div id="{{ $name }}-select-wrapper" wire:ignore>
        <x-bootstrap.form.select id="{{ $name }}-select" label="{{ $label }}" name="{{ $name }}"
            :wire="$wire" :col="$col" mb="{{ $mb }}" {{ $attributes }}>
            {{ $slot }}
        </x-bootstrap.form.select>
        <script>
            (function($) {
                $().ready(function() {

                    $("#{{ $name }}-select").select2();

                    $("#{{ $name }}-select").on('change', function(e) {

                        let data = $(this).val();
                        @this.set('{{ $name }}', data);

                    })
                    document.addEventListener('livewire:load', function () {


                    })

                })
            })($);
        </script>
    </div>
    @error('{{ $name }}')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

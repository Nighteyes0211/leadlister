<td {!! $attributes->merge(['class' => 'small']) !!} >
    {{-- {{ dd(isset($slot)) }} --}}
    {{ $slot }}
    <div class="table-links">
        @if (isset($actions))
            {{ $actions }}
        @endif
    </div>
</td>

@props(['tab' => ''])
<li class="nav-item">
    <a {!! $attributes->merge(['class' => 'nav-link']) !!} id="{{ $tab }}-tab" data-toggle="tab" href="#{{ $tab }}" role="tab">{{ $slot }}</a>
</li>

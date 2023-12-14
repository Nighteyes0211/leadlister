@props(['filter', 'item', 'label' => '', 'results' => 0])

@php
    $active = $filter == $item;
    $activeClass = $active ? 'active' : '';
@endphp

<li class="nav-item">
    <a {!! $attributes->merge(['class' => "nav-link $activeClass"]) !!}>{{ $label }} <span class="badge badge-{{ $active ? 'white' : 'primary' }}">{{ $results }}</span></a>
</li>

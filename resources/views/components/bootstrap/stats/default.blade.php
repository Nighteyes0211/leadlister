@props(['icon' => 'alpha-i-circle-outline', 'title' => 'title', 'value' => 'value'])

<x-bootstrap.card class="rounded-lg">
<div class="d-flex">
    {{-- icon --}}
    <div style="width: 5em; height: 5em" class="rounded-lg d-flex justify-content-center align-items-center bg-primary">
        <i class="mdi mdi-{{ $icon }} fs-3 text-white"></i>
    </div>

    {{-- Content  --}}
    <div class="ml-3 d-flex flex-column justify-content-center">
        <h4 class="font-weight-bold fs-5">{{ $title }}</h4>
        <p class="fs-5 mb-0 text-black-50 mt-2">{{ $value }}</p>
    </div>
</div>
</x-bootstrap.card>

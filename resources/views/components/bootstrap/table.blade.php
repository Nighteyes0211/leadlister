@props(['id' => uniqid(), 'datatable' => false, 'tableStyle' => 'striped'])
@section('page_css')
    @if ($datatable)
        <style>
            #table_{{ $id }}_wrapper label {
                width: 100%;
            }
        </style>
    @endif
@endsection
<div class="table-responsive text-small" id="table_{{ $id }}_wrapper">
    <table {!! $attributes->merge(['class' => "table table-{$tableStyle}"]) !!} id="{{ $id }}">
        <thead class="small">
            {{ $head }}
        </thead>
        <tbody>
            @if ($body->isNotEmpty())
                {{ $body }}
            @else
                <tr>
                    <td colspan="100">No records.</td>
                </tr>
            @endif
        </tbody>
    </table>

    @if ($datatable)
        <script>
            document.addEventListener('livewire:load', function() {
                console.log('asd');
                $('#{{ $id }}').dataTable();
            });
        </script>
    @endif
</div>

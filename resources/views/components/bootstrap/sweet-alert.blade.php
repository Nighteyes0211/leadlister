@props(['title' => '', 'message' => '', 'type' => 'success' ])
<script>
    $().ready(function() {
        swal("{{ $title }}", "{{ $message }}", "success");
    })
</script>

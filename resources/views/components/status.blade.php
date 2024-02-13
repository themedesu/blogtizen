@if (session('failure'))
<script>
    new Noty({
        text: "{{ session('failure') }}",
        type: "warning",
        theme: "sunset",
        timeout: 4000,
    }).show();
</script>
@endif
@if (session('success'))
<script>
    new Noty({
        text: "{{ session('success') }}",
        type: "success",
        theme: "sunset",
        timeout: 4000,
    }).show();
</script>
@endif
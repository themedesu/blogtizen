<script>
    if (typeof actionDelete != 'function') {
        $("[data-button-type=delete]").unbind('click');

        function actionDelete(button) {

            var button = $(button);
            var route = button.attr('data-route');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: route,
                type: 'DELETE',
                beforeSend:function(){
                    return confirm("Are you sure?");
                },
                success: function(result) {
                    new Noty({
                        text: result.messages,
                        type: result.type,
                        theme: "sunset",
                        timeout: 4000,
                    }).show();
                    if (document.getElementById('data-table')) {
                        $('#data-table').DataTable().ajax.reload();
                    } else {
                        setTimeout(function(){ 
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(result) {
                    new Noty({
                        text: "Something wrong with our admin-backend.",
                        type: "warning",
                        theme: "sunset",
                    }).show();
                }
            });
        }
    }
</script>
<script type="text/javascript">
    
    $("document").ready(function () {

        $('#check-all').change(function() {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });
        $('.checkbox').change(function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#check-all').prop('checked', true);
            }else{
                $('#check-all').prop('checked', false);
            }
        });


    });
</script>

</body>
</html>


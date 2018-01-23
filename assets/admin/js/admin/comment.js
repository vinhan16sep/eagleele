var url_base = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '');
$('.btn-remove').click(function (e) {
    var check = $(this);
    e.preventDefault();
    var id = $(this).data('id');
    jQuery.ajax({
        type: "get",
        url: url_base + "/eagleele/admin/comment/remove",
        // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
        data: {id : id},
        success: function(result){
            check.parents('.row_'+id).fadeOut();
        }
    })
    return false;
});
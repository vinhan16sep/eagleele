var url_base = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '');
/* comment */
$('.submit-comment').click(function(e){
    e.preventDefault();
    var name = $('#name').val();
    var email = $('#email').val();
    var content = $('#content').val();
    var category = $('#category').val();
    var id = $('#id').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(name.length == 0){
        $('.name_error').text('Họ và Tên không được trống!');
    }else{
        $('.name_error').text('');
    }

    if(email.length == 0){
        $('.email_error').text('Email không được trống!');
    }
    else{
        $('.email_error').text('');
    }

    if(content.length == 0){
        $('.content_error').text('Nội dung không được trống!');
    }
    else{
        $('.content_error').text('');
    }
    if(name.length != 0 && email.length != 0 && content.length != 0){

        if(filter.test(email)){
            $('.submit-comment').hide();
            $('.cmt_error').hide();
            jQuery.ajax({
                type: "get",
                url: url_base + "/eagleele/comment/create_comment",
                // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
                data: {name : name, email : email, content : content, category : category, id : id},
                success: function(result){
                    $('#comment > .cmt:first-child').before(JSON.parse(result).comment);
                    $('#name').val('');
                    $('#email').val('');
                    $('#content').val('');
                    $('.submit-comment').show();
                }
            })
        }else{
            $('.email_error').text('Định dạng email không đúng, Vui lòng kiểm tra lại!');
        }

    }

    return false;
});

// see more comment
var page = 1;
$('#comment_readmore').click(function () {
    var id = $('#id').val();
    var category = $('#category').val();
    var total_cmt = $('#count-comment').val();
    page_cmt = parseInt(total_cmt) / 5;
    page ++;
    jQuery.ajax({
        type: "get",
        url: url_base + "/eagleele/comment/see_more_comment",
        // url: location.protocol + "//" + location.host + (location.port ? ':' + location.port : '') + "/tuoithantien/comment/create_comment",
        data: {page : page, id : id, category : category},
        success: function(result){
            $('#comment > .cmt:last-child').after(result);
            if(page_cmt <= page){
                $('#comment_readmore').fadeOut();
            }
        }
    })
});
<style>
    .checkout-wrapper{padding-top: 40px; padding-bottom:40px; background-color: #fafbfa;}
    .checkout{    background-color: #fff;
        border:1px solid #eaefe9;

        font-size: 14px;}
    .panel{margin-bottom: 0px;}
    .checkout-step {

        border-top: 1px solid #f2f2f2;
        color: #666;
        font-size: 14px;
        padding: 30px;
        position: relative;
    }

    .checkout-step-number {
        border-radius: 50%;
        border: 1px solid #666;
        display: inline-block;
        font-size: 12px;
        height: 32px;
        margin-right: 26px;
        padding: 6px;
        text-align: center;
        width: 32px;
    }
    .checkout-step-title{ font-size: 18px;
        font-weight: 500;
        vertical-align: middle;display: inline-block; margin: 0px;
    }

    .checout-address-step{}
    .checout-address-step .form-group{margin-bottom: 18px;display: inline-block;
        width: 100%;}

    .checkout-step-body{padding-left: 60px; padding-top: 30px;}

    .checkout-step-active{display: block;}
    .checkout-step-disabled{display: none;}

    .checkout-login{}
    .login-phone{display: inline-block;}
    .login-phone:after {
        content: '+91 - ';
        font-size: 14px;
        left: 36px;
    }
    .login-phone:before {
        content: "";
        font-style: normal;
        color: #333;
        font-size: 18px;
        left: 12px;
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .login-phone:after, .login-phone:before {
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .login-phone .form-control {
        padding-left: 68px;
        font-size: 14px;

    }
    .checkout-login .btn{height: 42px;     line-height: 1.8;}

    .otp-verifaction{margin-top: 30px;}
    .checkout-sidebar{background-color: #fff;
        border:1px solid #eaefe9; padding: 30px; margin-bottom: 30px;}
    .checkout-sidebar-merchant-box{background-color: #fff;
        border:1px solid #eaefe9; margin-bottom: 30px;}
    .checkout-total{border-bottom: 1px solid #eaefe9; padding-bottom: 10px;margin-bottom: 10px; }
    .checkout-invoice{display: inline-block;
        width: 100%;}
    .checout-invoice-title{    float: left; color: #30322f;}
    .checout-invoice-price{    float: right; color: #30322f;}
    .checkout-charges{display: inline-block;
        width: 100%;}
    .checout-charges-title{float: left; }
    .checout-charges-price{float: right;}
    .charges-free{color: #43b02a; font-weight: 600;}
    .checkout-payable{display: inline-block;
        width: 100%; color: #333;}
    .checkout-payable-title{float: left; }
    .checkout-payable-price{float: right;}

    .checkout-cart-merchant-box{ padding: 20px;display: inline-block;width: 100%; border-bottom: 1px solid #eaefe9;
        padding-bottom: 20px; }
    .checkout-cart-merchant-name{color: #30322f; float: left;}
    .checkout-cart-merchant-item{ float: right; color: #30322f; }
    .checkout-cart-products{}

    .checkout-cart-products .checkout-charges{ padding: 10px 20px;
        color: #333;}
    .checkout-cart-item{ border-bottom: 1px solid #eaefe9;
        box-sizing: border-box;
        display: table;
        font-size: 12px;
        padding: 22px 20px;
        width: 100%;}
    .checkout-item-list{}
    .checkout-item-count{ float: left; }
    .checkout-item-img{width: 60px; float: left;}
    .checkout-item-name-box{ float: left; }
    .checkout-item-title{ color: #30322f; font-size: 14px;  }
    .checkout-item-unit{  }
    .checkout-item-price{float: right;color: #30322f; font-size: 14px; font-weight: 600;}


    .checkout-viewmore-btn{padding: 10px; text-align: center;}

    .header-checkout-item{text-align: right; padding-top: 20px;}
    .checkout-promise-item {
        background-repeat: no-repeat;
        background-size: 14px;
        display: inline-block;
        margin-left: 20px;
        padding-left: 24px;
        color: #30322f;
    }
    .checkout-promise-item i{padding-right: 10px;color: #43b02a;}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open_multipart('', array('class' => 'form-horizontal'));
            ?>
            <div id="accordion" class="checkout">
                <div class="panel checkout-step">
                    <div role="tab" id="headingOne"> <span class="checkout-step-number">1</span>
                        <h4 class="checkout-step-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" > Basic Info</a></h4>
                    </div>
                    <div id="collapseOne" class="collapse in">
                        <div class="checkout-step-body">
                            <div class="row">
                                <div class="form-group">
                                    <?php
                                    echo form_label('Type', 'type');
                                    echo form_error('type');
                                    echo form_dropdown('type', array('0' => 'Event', '1' => 'News'), set_value('type', $article['type']), 'class="form-control type"');
                                    ?>
                                </div>
                                <div class="form-group picture">
                                    <?php
                                    echo form_label('Ảnh đại diện / Picture', 'picture');
                                    echo form_error('picture');
                                    echo form_upload('picture', set_value('picture'), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group picture">
                                    <?php
                                    echo form_label('Banner', 'banner');
                                    echo form_error('banner');
                                    echo form_upload('banner', set_value('banner'), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group etime">
                                    <?php
                                    echo form_label('Thời gian', 'time');
                                    ?>
                                    <div id="event-time">
                                    </div>
                                    <?php
                                    $data_month = array(
                                        'type'  => 'hidden',
                                        'name'  => 'event_month',
                                        'id'    => 'eventMonth',
                                        'value' => isset($time[1]) ? (int)$time[1] : '',
                                        'class' => 'eventMonth'
                                    );
                                    echo form_input($data_month);

                                    $data_date = array(
                                        'type'  => 'hidden',
                                        'name'  => 'event_date',
                                        'id'    => 'eventDate',
                                        'value' => isset($time[2]) ? (int)$time[2] : '',
                                        'class' => 'eventDate'
                                    );
                                    echo form_input($data_date);

                                    $data_year = array(
                                        'type'  => 'hidden',
                                        'name'  => 'event_year',
                                        'id'    => 'eventYear',
                                        'value' => isset($time[0]) ? (int)$time[0] : '',
                                        'class' => 'eventYear'
                                    );
                                    echo form_input($data_year);
                                    ?>
                                    <?php
                                    $hours = array(
                                        '' => 'Giờ'
                                    );
                                    for($i = 0; $i < 24; $i++){
                                        if($i < 10){
                                            $i = '0' . $i;
                                        }
                                        $hours[$i] = $i;
                                    }
                                    echo form_label('', 'event_hour');
                                    echo form_error('event_hour');
                                    echo form_dropdown('event_hour', $hours, set_value('event_hour', isset($time[3]) ? (int)$time[3] : ''), 'class="form-control"');
                                    ?>
                                    <?php
                                    $minutes = array(
                                        '' => 'Phút'
                                    );
                                    for($i = 0; $i < 60; $i++){
                                        if($i < 10){
                                            $i = '0' . $i;
                                        }
                                        $minutes[$i] = $i;
                                    }
                                    echo form_label('', 'event_min');
                                    echo form_error('event_min');
                                    echo form_dropdown('event_min', $minutes, set_value('event_min', isset($time[4]) ? (int)$time[4] : ''), 'class="form-control"');
                                    ?>
                                </div>
                                <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Next</a>
                                <!-- /.col-lg-6 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel checkout-step">
                    <div role="tab" id="headingTwo"> <span class="checkout-step-number">2</span>
                        <h4 class="checkout-step-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" > Tiếng Việt </a> </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="checkout-step-body">
                            <div class="row">
                                <div class="form-group elocation">
                                    <?php
                                    echo form_label('Địa điểm event', 'location_vi');
                                    echo form_error('location_vi');
                                    echo form_input('location_vi', set_value('location_vi', $article['location_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group eaddress">
                                    <?php
                                    echo form_label('Địa chỉ event', 'address_vi');
                                    echo form_error('address_vi');
                                    echo form_input('address_vi', set_value('address_vi', $article['address_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group ecost">
                                    <?php
                                    echo form_label('Chi phí', 'cost_vi');
                                    echo form_error('cost_vi');
                                    echo form_input('cost_vi', set_value('cost_vi', $article['cost_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Tiêu đề', 'title_vi');
                                    echo form_error('title_vi');
                                    echo form_input('title_vi', set_value('title_vi', $article['title_vi']), 'class="form-control title_vi"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Slug', 'slug_vi');
                                    echo form_error('slug_vi');
                                    echo form_input('slug_vi', set_value('slug_vi', $article['slug_vi']), 'class="form-control slug_vi" readonly="readonly"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Meta Description', 'meta_description_vi');
                                    echo form_error('meta_description_vi');
                                    echo form_input('meta_description_vi', set_value('meta_description_vi', $article['meta_description_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Meta Keywords', 'meta_keywords_vi');
                                    echo form_error('meta_keywords_vi');
                                    echo form_input('meta_keywords_vi', set_value('meta_keywords_vi', $article['meta_keywords_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group description">
                                    <?php
                                    echo form_label('Tóm tắt', 'description_vi');
                                    echo form_error('description_vi');
                                    echo form_textarea('description_vi', set_value('description_vi', $article['description_vi']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Nội dung', 'content_vi');
                                    echo form_error('content_vi');
                                    echo form_textarea('content_vi', set_value('content_vi', $article['content_vi'], false), 'class="form-control blog-content"')
                                    ?>
                                </div>
                                <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Next</a>
                                <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel checkout-step">
                    <div role="tab" id="headingThree"> <span class="checkout-step-number">3</span>
                        <h4 class="checkout-step-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" > English </a> </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="checkout-step-body">
                            <div class="row">
                                <div class="form-group elocation">
                                    <?php
                                    echo form_label('Location', 'location_en');
                                    echo form_error('location_en');
                                    echo form_input('location_en', set_value('location_en', $article['location_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group eaddress">
                                    <?php
                                    echo form_label('Address', 'address_en');
                                    echo form_error('address_en');
                                    echo form_input('address_en', set_value('address_en', $article['address_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group ecost">
                                    <?php
                                    echo form_label('Cost', 'cost_en');
                                    echo form_error('cost_en');
                                    echo form_input('cost_en', set_value('cost_en', $article['cost_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Title', 'title_en');
                                    echo form_error('title_en');
                                    echo form_input('title_en', set_value('title_en', $article['title_en']), 'class="form-control title_en"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Slug', 'slug_en');
                                    echo form_error('slug_en');
                                    echo form_input('slug_en', set_value('slug_en', $article['slug_en']), 'class="form-control slug_en" readonly="readonly"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Meta Description', 'meta_description_en');
                                    echo form_error('meta_description_en');
                                    echo form_input('meta_description_en', set_value('meta_description_en', $article['meta_description_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Meta Keywords', 'meta_keywords_en');
                                    echo form_error('meta_keywords_en');
                                    echo form_input('meta_keywords_en', set_value('meta_keywords_en', $article['meta_keywords_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group description">
                                    <?php
                                    echo form_label('Description', 'description_en');
                                    echo form_error('description_en');
                                    echo form_textarea('description_en', set_value('description_en', $article['description_en']), 'class="form-control"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Content', 'content_en');
                                    echo form_error('content_en');
                                    echo form_textarea('content_en', set_value('content_en', $article['content_en'], false), 'class="form-control blog-content"')
                                    ?>
                                </div>
                                <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group col-sm-12 text-right">
                <?php
                echo form_submit('submit', 'OK', 'class="btn btn-primary"');
                echo form_close();
                ?>
                <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Go back</a>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo site_url('assets/admin/js/jquery-1.8.3.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/js/jquery-birthday-picker.min.js'); ?>"></script>
<script>

    $("#event-time").birthdayPicker({
        sizeClass: "form-control"
    });

    if($('.type').val() == 0){
        hide_news_type();
    }else{
        hide_event_type();
    }

    $('.type').change(function(){
        if($('.type').val() == 0){
            hide_news_type();
        }else{
            hide_event_type();
        }
    });

    function hide_news_type(){
        // hide news stuffs
        $('.category').hide();

        // show event stuffs
        $('.etime').show();
        $('.elocation').show();
        $('.eaddress').show();
        $('.ecost').show();
    }
    function hide_event_type(){
        // hide event stuffs
        $('.etime').hide();
        $('.elocation').hide();
        $('.eaddress').hide();
        $('.ecost').hide();

        // show news stuffs
        $('.category').show();
    }

    $(window).on('load', function() {
        $('.birthMonth').val($('#eventMonth').val());
        $('.birthDate').val($('#eventDate').val());
        $('.birthYear').val($('#eventYear').val());
    });
</script>
<script type="text/javascript" src="<?php echo site_url('tinymce/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: ".blog-content",
        theme: "modern",
        height: 200,
        relative_urls: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: "Bold text", inline: "b"},
            {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
            {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
            {title: "Example 1", inline: "span", classes: "example1"},
            {title: "Example 2", inline: "span", classes: "example2"},
            {title: "Table styles"},
            {title: "Table row 1", selector: "tr", classes: "tablerow1"}
        ],
        external_filemanager_path: "<?php echo site_url('filemanager/'); ?>",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": "<?php echo site_url('filemanager/plugin.min.js'); ?>"}
    });

    $('.title_vi').blur(function(){
        var slug = to_slug($('.title_vi').val());
        $('.slug_vi').val(slug);
    });

    $('.title_en').blur(function(){
        var slug = to_slug($('.title_en').val());
        $('.slug_en').val(slug);
    });
</script>
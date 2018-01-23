<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
    <div class="cover">
        <img src="img/cover-100.jpg">
    </div>
    <div class="news-post">
        <div class="row">
            <div class="left col-md-8 col-sm-8 col-xs-8">
                <div class="content-title">
                    <h2>Thư viện</h2>
                </div>

                <article>
                    <h1><?php echo $library['library_title']; ?></h1>
                    <?php echo $library['library_content']; ?>
                </article>

            </div>
            <div class="right col-md-4 col-sm-4 col-xs-4">
                <div class="content-title">
                    <h2>Đăng ký nhận sách</h2>
                </div>
                <div class="contact-form">
                    <label for="inputName">Họ tên (*)</label>
                    <input type="type" class="form-control" id="inputName" placeholder="Họ tên">
                    <br>
                    <label for="inputEmail">Email (*)</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    <br>
                    <label for="inputPhone">Số điện thoại (*)</label>
                    <input type="type" class="form-control" id="inputPhone" placeholder="Số điện thoại">
                    <br>
                    <button type="submit" class="btn btn-default btn-fill">Nhận sách</button>
                </div>
            </div>
        </div>

        <div class="comments">

            <?php echo form_open(""); ?>
            <div class="row">
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label('Họ và Tên', 'name');
                    echo form_input('name', set_value('name'), 'class="form-control" id="name" placeholder="Họ và tên phụ huynh"');
                    ?>
                    <span class="name_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label('Email', 'email');
                    // echo form_error('email');
                    echo form_input('email', set_value('email'), 'class="form-control" id="email" placeholder="Email"');
                    ?>
                    <span class="email_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <?php
                    echo form_label('Ý kiến nhận xét', 'content');
                    echo form_textarea('content', set_value('content'), 'class="form-control" rows="5" id="content"');
                    ?>
                    <span class="content_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" name="category" value="<?php echo $category ?>" id="category">
                    <input type="hidden" name="id" value="<?php echo $library['id'] ?>" id="id">
                    <?php echo form_submit('submit', 'Gửi nhận xét', 'class="btn btn-primary hvr-icon-forward submit-comment"'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <div id="comment">
            <?php if (isset($comment)): ?>
                <?php foreach ($comment as $value): ?>
                    <div class="media cmt">
                        <div class="media-left">
                            <img class="media-object" src="<?php echo site_url('assets/public/img/comment_ava.png') ?>" alt="Comment Avatar" width="64">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading" style="color: #f4aa1c"><?php echo $value['name'] ?></h3>
                            <span><?php echo $value['content'] ?></span>
                            <span style="float: right; font-size: 1em"><?php echo $value['created_at'] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="media cmt">
                    <p class="cmt_error">Chưa có bình luận cho bài viết này</p>
                </div>
            <?php endif ?>
        </div>
        <?php if ($total_comment > 5): ?>
        <div id="comment_readmore">
            <input type="hidden" name="count-comment" id="count-comment" value="<?php echo $total_comment ?>">
            <button class="btn btn-primary btn-sm center-block" type="submit">Xem thêm bình luận</button>
        </div>
        <?php endif ?>

    </div>
</section>
<script src="<?php echo site_url('assets/public/js/comment.js'); ?>"></script>

<!-- InstanceEndEditable -->
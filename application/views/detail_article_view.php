<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
    <div class="cover">
        <img src="<?php echo (!empty($article['banner'])) ? base_url('assets/upload/banner/' . $article['banner']) : base_url('assets/public/img/cover-100.jpg') ?>">
    </div>
    <div class="news-post">
        <div class="row">
            <div class="left col-md-12 col-sm-12 col-xs-12">
                <div class="content-title">
                    <h2><?php echo $category; ?></h2>
                    <div class="title-underline"></div>
                </div>

                <article>
                    <h1><?php echo $article['article_title']; ?></h1>
                    <?php echo $article['article_content']; ?>
                </article>
            </div>
            <?php if($article['type'] == 1): ?>
<!--            <div class="right col-md-4 col-sm-4 col-xs-12">-->
<!--                <div class="content-title">-->
<!--                    <h2>Categories</h2>-->
<!--                    <div class="title-underline"></div>-->
<!--                </div>-->
<!--                <ul>-->
<!--                    --><?php //if($list_categories): ?>
<!--                        --><?php //foreach($list_categories as $item): ?>
<!--                            <li><a href="--><?php //echo site_url('article/news/' . $item['category_id']); ?><!--">--><?php //echo $item['title']; ?><!--</a></li>-->
<!--                        --><?php //endforeach; ?>
<!--                    --><?php //endif; ?>
<!--                </ul>-->
<!--            </div>-->
            <?php endif; ?>
        </div>

        <div class="comments">

            <?php echo form_open(""); ?>
            <div class="row">
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label( $this->lang->line('comment_name'), 'name');
                    echo form_input('name', set_value('name'), 'class="form-control" id="name" placeholder="' . $this->lang->line('comment_placeholder_name') . '"');
                    ?>
                    <span class="name_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label( 'Email', 'email');
                    // echo form_error('email');
                    echo form_input('email', set_value('email'), 'class="form-control" id="email" placeholder="' . $this->lang->line('comment_placeholder_email') . '"');
                    ?>
                    <span class="email_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <?php
                    echo form_label( $this->lang->line('comment_message'), 'content');
                    echo form_textarea('content', set_value('content'), 'class="form-control" rows="5" id="content" placeholder="' . $this->lang->line('comment_placeholder_message') . '"');
                    ?>
                    <span class="content_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" name="category" value="<?php echo $category_cmt ?>" id="category">
                    <input type="hidden" name="id" value="<?php echo $article['id'] ?>" id="id">
                    <?php echo form_submit('submit',  $this->lang->line('comment_submit'), 'class="btn btn-fill submit-comment"'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <div id="comment">
            <?php if (isset($comment)): ?>
                <?php foreach ($comment as $value): ?>
                    <div class="media cmt">
                        <div class="media-left">
                            <img class="media-object" src="<?php echo site_url('assets/public/img/comment_ava.png') ?>" alt="Comment Avatar">
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
                    <p class="cmt_error"><?php echo $this->lang->line('comment_nocomment') ?></p>
                </div>
            <?php endif ?>
        </div>
        <?php if ($total_comment > 5): ?>
        <div id="comment_readmore">
            <input type="hidden" name="count-comment" id="count-comment" value="<?php echo $total_comment ?>">
            <button class="btn btn-primary btn-sm center-block" type="submit"><?php echo $this->lang->line('comment_seemore') ?></button>
        </div>
        <?php endif ?>

    </div>



</section>
<script src="<?php echo site_url('assets/public/js/comment.js'); ?>"></script>

<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="cover">
		<img src="<?php echo base_url('assets/public/img/banner/training.jpg'); ?>">
	</div>
	<div class="news-post">
		<div class="row">
			<div class="left col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="content-title">
					<h2><?php echo $this->lang->line('advice') ?></h2>
					<div class="title-underline"></div>
				</div>

                <article>
                    <h1><?php echo $advice['advice_title']; ?></h1>

                    <?php echo $advice['advice_content']; ?>
                </article>
			</div>
			<!--<div class="right col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="content-title">
					<h2><?php echo $this->lang->line('contact_title') ?></h2>
					<div class="title-underline"></div>
				</div>
				<div class="contact-form">
					<label for="inputName"><?php echo $this->lang->line('contact_name') ?> (*)</label>
					<input type="type" class="form-control" id="inputName" placeholder="<?php echo $this->lang->line('contact_name') ?>">
					<br>
					<label for="inputEmail"><?php echo $this->lang->line('contact_email') ?> (*)</label>
					<input type="email" class="form-control" id="inputEmail" placeholder="<?php echo $this->lang->line('contact_email') ?>">
					<br>
					<label for="inputPhone"><?php echo $this->lang->line('contact_phone') ?> (*)</label>
					<input type="type" class="form-control" id="inputPhone" placeholder="<?php echo $this->lang->line('contact_phone') ?>">
					<br>
					<label for="inputPhone"><?php echo $this->lang->line('contact_position') ?></label>
					<select class="form-control" id="inputReason">
					  <option><?php echo $this->lang->line('contact_position_1') ?></option>
					  <option><?php echo $this->lang->line('contact_position_2') ?></option>
					  <option><?php echo $this->lang->line('contact_position_3') ?></option>
					  <option><?php echo $this->lang->line('contact_position_4') ?></option>
					  <option><?php echo $this->lang->line('contact_position_5') ?></option>
					</select>
					<br>
					<button type="submit" class="btn btn-default btn-fill"><?php echo $this->lang->line('contact_send') ?></button>
				</div>
			</div>-->
		</div>

        <div class="comments">

            <?php echo form_open(""); ?>
            <div class="row">
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label( $this->lang->line('comment_name') , 'name');
                    echo form_input('name', set_value('name'), 'class="form-control" id="name" placeholder="' . $this->lang->line('comment_placeholder_name') . '"');
                    ?>
                    <span class="name_error" style="color: red"></span>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <?php
                    echo form_label('Email', 'email');
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
                    <input type="hidden" name="category" value="<?php echo $category ?>" id="category">
                    <input type="hidden" name="id" value="<?php echo $advice['id'] ?>" id="id">
                    <?php echo form_submit('submit', $this->lang->line('comment_submit'), 'class="btn btn-fill submit-comment"'); ?>
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
                    <p class="cmt_error"><?php echo $this->lang->line('comment_nocomment') ?></p>
                </div>
            <?php endif ?>
        </div>
        <?php if ($total_comment > 5): ?>
        <div id="comment_readmore">
            <input type="hidden" name="count-comment" id="count-comment" value="<?php echo $total_comment ?>">
            <button class="btn btn-fill btn-sm center-block" type="submit"><?php echo $this->lang->line('comment_seemore') ?></button>
        </div>
        <?php endif ?>
				
	</div>
	
	
	
</section>
<script src="<?php echo site_url('assets/public/js/comment.js'); ?>"></script>

<!-- InstanceEndEditable -->
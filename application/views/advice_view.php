<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="row">
		<div class="navside col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="content-title">
				<h2><?php echo $this->lang->line('advice'); ?></h2>
				<div class="title-underline"></div>
			</div>
			<ul>
				<li><a href="<?php echo site_url('advice/index/1'); ?>"><?php echo $this->lang->line('advice_navside_1'); ?></a></li>
				<li><a href="<?php echo site_url('advice/index/2'); ?>"><?php echo $this->lang->line('advice_navside_2'); ?></a></li>
				<li><a href="<?php echo site_url('advice/index/3'); ?>"><?php echo $this->lang->line('advice_navside_3'); ?></a></li>
				<li><a href="<?php echo site_url('advice/index/4'); ?>"><?php echo $this->lang->line('advice_navside_4'); ?></a></li>
                <li><a href="<?php echo site_url('advice/index/4'); ?>"><?php echo $this->lang->line('advice_navside_5'); ?></a></li>
                <li><a href="<?php echo site_url('advice/index/4'); ?>"><?php echo $this->lang->line('advice_navside_6'); ?></a></li>
                <li><a href="<?php echo site_url('advice/index/4'); ?>"><?php echo $this->lang->line('advice_navside_7'); ?></a></li>
			</ul>
		</div>
		
		<div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="content-title">
				<h3><?php echo $advice['advice_title']; ?></h3>
				<div class="title-underline"></div>
			</div>
			<?php echo $advice['advice_content']; ?>
			
			<div class="advice-form">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="content-title">
						<h3><?php echo $this->lang->line('advice_info'); ?></h3>
					</div>
					<label><?php echo $this->lang->line('advice_address'); ?></label>
					<p><?php echo $this->lang->line('advice_address_info'); ?></p>
					<label><?php echo $this->lang->line('advice_phone'); ?></label>
					<p><?php echo $this->lang->line('advice_phone_info'); ?></p>
					<label><?php echo $this->lang->line('advice_hotline'); ?></label>
					<p><?php echo $this->lang->line('advice_hotline_info'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="content-title">
						<h3><?php echo $this->lang->line('advice_email'); ?></h3>
					</div>
					<label for="inputName"><?php echo $this->lang->line('advice_email_name'); ?> (*)</label>
					<input type="type" class="form-control" id="inputName" placeholder="<?php echo $this->lang->line('advice_email_name'); ?>">
					<br>
					<label for="inputEmail"><?php echo $this->lang->line('advice_email_email'); ?> (*)</label>
					<input type="email" class="form-control" id="inputEmail" placeholder="<?php echo $this->lang->line('advice_email_email'); ?>">
					<br>
					<label for="inputPhone"><?php echo $this->lang->line('advice_email_phone'); ?> (*)</label>
					<input type="type" class="form-control" id="inputPhone" placeholder="<?php echo $this->lang->line('advice_email_phone'); ?>">
					<br>
					<textarea class="form-control" rows="4" placeholder="<?php echo $this->lang->line('advice_email_content'); ?>"></textarea>
					<br>
					<button type="submit" class="btn btn-default btn-fill"><?php echo $this->lang->line('advice_email_send'); ?></button>
				</div>
			</div>
		</div>
	</div>
</section>
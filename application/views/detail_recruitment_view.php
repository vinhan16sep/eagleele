<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="cover">
		<img src="<?php echo base_url('assets/public/img/banner/tuyen-dung.jpg'); ?>">
	</div>
	<div class="news-post">
		<div class="row">
			<div class="left col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="content-title">
					<h2><?php echo $this->lang->line('recruitment') ?></h2>
					<div class="title-underline"></div>
				</div>
				
				<h1><?php echo $recruitment['recruitment_title']; ?></h1>
				
				<?php echo $recruitment['recruitment_content']; ?>
				
			</div>
			<div class="right col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
			</div>
		</div>
				
	</div>
	
	
	
</section>

<!-- InstanceEndEditable -->
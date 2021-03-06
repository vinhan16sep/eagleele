<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="row">
		<div class="navside col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="content-title">
				<h2><?php echo $this->lang->line('introduce'); ?></h2>
				<div class="title-underline"></div>
			</div>
			<ul>
				<li><a href="<?php echo site_url('introduce'); ?>"><?php echo $this->lang->line('about_us'); ?></a></li>
				<li><a href="<?php echo site_url('introduce/teachers'); ?>"><?php echo $this->lang->line('teachers'); ?></a></li>
			</ul>
		</div>
		
		<div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="content-title">
				<h3><?php echo $this->lang->line('partners'); ?></h3>
				<div class="title-underline"></div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<?php echo $partner['partner_content']; ?>
				</div>
				<div class="coach col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<img src="<?php echo base_url('assets/upload/partner/' . $partner['description_image']); ?>">
					<a href="javascript:void(0);"><label> <?php echo $partner['partner_name']; ?></label></a>
				</div>
			</div>
			
		</div>
	</div>
</section>

<!-- InstanceEndEditable -->
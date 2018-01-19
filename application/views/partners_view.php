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
				<li><a href="<?php echo site_url('introduce/why_us'); ?>"><?php echo $this->lang->line('why_us'); ?></a></li>

				<li><a href="<?php echo site_url('introduce/message'); ?>"><?php echo $this->lang->line('message'); ?></a></li>
				<li><a href="<?php echo site_url('introduce/vision'); ?>"><?php echo $this->lang->line('visison'); ?></a></li>
				<li><a href="<?php echo site_url('introduce/teachers'); ?>"><?php echo $this->lang->line('teachers'); ?></a></li>
				<li><a href="<?php echo site_url('introduce/partners'); ?>"><?php echo $this->lang->line('partners'); ?></a></li>
			</ul>
		</div>
		
		<div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="content-title">
				<h3><?php echo $this->lang->line('partners'); ?></h3>
				<div class="title-underline"></div>
			</div>
			<?php foreach($partners as $item): ?>
				<div class="coach col-lg-4 col-md-4 col-sm-4 col-xs-6">
					<img src="<?php echo base_url('assets/upload/partner/' . $item['description_image']); ?>">
					<a href="<?php echo site_url('introduce/detail_partner/' . $item['partner_id']); ?>"><label> <?php echo $item['name']; ?></label></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- InstanceEndEditable -->
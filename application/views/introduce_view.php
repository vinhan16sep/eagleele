<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="row">
		<div class="navside col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="content-title" style="margin-bottom:0px !important">
				<h2>Giới thiệu</h2>
				<div class="title-underline"></div>
			</div>
			<ul>
				<li><a href="<?php echo site_url('introduce'); ?>">Về chúng tôi</a></li>
<!--				<li><a href="--><?php //echo site_url('introduce/why_us'); ?><!--">Tại sao nên chọn chúng tôi</a></li>-->
<!---->
<!--				<li><a href="--><?php //echo site_url('introduce/message'); ?><!--">Thông điệp</a></li>-->
<!--				<li><a href="--><?php //echo site_url('introduce/vision'); ?><!--">Tầm nhìn, sứ mệnh</a></li>-->
				<li><a href="<?php echo site_url('introduce/teachers'); ?>">Giảng viên</a></li>
<!--				<li><a href="--><?php //echo site_url('introduce/partners'); ?><!--">Đối tác chiến lược</a></li>-->
			</ul>
		</div>
		
		<div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="content-title">
				<h3><?php echo $introduce['introduce_title']; ?></h3>
			</div>
			<?php echo $introduce['introduce_content']; ?>
            <br>
            <div class="content-title">
                <h3><?php echo $this->lang->line('partners'); ?></h3>
                <div class="title-underline"></div>
            </div>
            <?php foreach($partners as $item): ?>
                <div class="coach col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <img src="<?php echo base_url('assets/upload/partner/' . $item['description_image']); ?>">
                    <a href="<?php echo site_url('introduce/detail_partner/' . $item['slug']); ?>"><label> <?php echo $item['name']; ?></label></a>
                </div>
            <?php endforeach; ?>
		</div>
	</div>
</section>

<!-- InstanceEndEditable -->
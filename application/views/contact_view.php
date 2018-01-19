<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
	<div class="row">
		<div class="contact-navside col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php
            echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'contact-form'));
            ?>
			<div class="content-title">
				<h2><?php echo $this->lang->line('contact_info'); ?></h2>
			</div>
			<ul>
				<li><?php echo $this->lang->line('contact_address_info'); ?></li>
				<li><?php echo $this->lang->line('contact_phone'); ?>: <?php echo $this->lang->line('contact_phone_info'); ?></li>
				<li><?php echo $this->lang->line('contact_hotline'); ?>: <?php echo $this->lang->line('contact_hotline_info'); ?></li>
				<li><?php echo $this->lang->line('contact_email_info'); ?>: <?php echo $this->lang->line('contact_our_mail'); ?></li>
			</ul>
			
			<div class="content-title">
				<h2><?php echo $this->lang->line('contact_email'); ?></h2>
			</div>
			<div class="contact-form">
                <?php
                echo form_label($this->lang->line('contact_email_name') . '(*)', 'name');
                echo form_error('name');
                echo form_input('name', set_value('name'), 'class="form-control contact_name" placeholder="' . $this->lang->line('contact_email_name') . '"');
                ?>
    			<br>
                <?php
                echo form_label($this->lang->line('contact_email_info') . '(*)', 'email');
                echo form_error('email');
                echo form_input('email', set_value('email'), 'class="form-control" placeholder="' . $this->lang->line('contact_email_info') . '"');
                ?>
    			<br>
                <?php
                echo form_label($this->lang->line('contact_email_phone') . '(*)', 'phone');
                echo form_error('phone');
                echo form_input('phone', set_value('phone'), 'class="form-control" placeholder="' . $this->lang->line('contact_email_phone') . '"');
                ?>
    			<br>
                <?php
                $options = array(
                    '1' => $this->lang->line('contact_reason_1'),
                    '2' => $this->lang->line('contact_reason_2'),
                    '3' => $this->lang->line('contact_reason_3'),
                    '4' => $this->lang->line('contact_reason_4'),
                    '5' => $this->lang->line('contact_reason_5'),
                );
                echo form_label($this->lang->line('contact_reason'), 'reason');
                echo form_error('reason');
                echo form_dropdown('reason', $options, set_value('reason', 1), 'class="form-control type"');
                ?>
				<br>
                <?php
                echo form_label($this->lang->line('contact_email_content') . '(*)', 'content');
                echo form_error('content');
                echo form_textarea('content', set_value('content'), 'class="form-control" rows="4" placeholder="' . $this->lang->line('contact_email_content') . '"');
                ?>
				<br>
                <?php
                echo form_submit('submit', $this->lang->line('contact_email_send'), 'class="btn btn-default btn-fill"');
                ?>
			</div>
            <?php
            echo form_close();
            ?>
		</div>
		
		<div class="about-content col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="map" id="map"></div>
		</div>
	</div>
</section>

<!-- InstanceEndEditable -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVldQrvD6TdflBLsoI9eNdXBUwHFwvp-c&callback=initMap">
</script>
<script>
    function initMap() {
        var uluru = {lat: 21.0135237, lng: 105.8153028};
        var iconBase = {
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: uluru,
            scrollwheel: false,

        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            icon: "assets/public/img/marker.png"
        });
    }

    $('form#contact-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('contact/create'); ?>",
            data: {
                input: $("#contact-form").serialize()
            },
            success: function(res){
                alert('Cảm ơn ' + $('.contact_name').val() + ', ý kiến của bạn đã được gửi!');
            },
            error: function() { alert("Error mail."); }
        });

    });
</script>
<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
    <div id="news-content">
        <?php foreach($projects as $item): ?>
            <div class="news-recruit col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="news-img">
                    <?php if(isset($item['description_image']) && !empty($item['description_image'])): ?>
                        <img src="<?php echo base_url('assets/upload/project/' . $item['description_image']); ?>">
                    <?php else: ?>
                        <img src="<?php echo base_url('assets/public/img/no-intro-image.jpg'); ?>">
                    <?php endif; ?>
                </div>
                <div class="news-intro">
                    <div class="content-title">
                        <h2><?php echo $item['title']; ?></h2>
                    </div>
                    <p><?php echo $item['description']; ?></p>
                    <a class="btn btn-default btn-fill" href="<?php echo site_url('project/detail/' . $item['project_id']); ?>" role="button">
                        <?php echo $this->lang->line('read_more') ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- InstanceEndEditable -->
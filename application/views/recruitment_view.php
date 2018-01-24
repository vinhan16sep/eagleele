<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/css/blogs.css'); ?>">

<section class="main-content container">
    <div id="news-content">
        <?php foreach($recruitments as $item): ?>
        <div class="news-recruit col-md-4 col-sm-4 col-xs-12">
            <div class="news-img">
                <img src="<?php echo (isset($item['description_image']) && !empty($item['description_image'])) ?
                    base_url('assets/upload/recruitment/' . $item['description_image'])
                    : base_url('assets/public/img/no-intro-image.jpg'); ?>" alt="img">
            </div>
            <div class="news-intro">
                <a href="<?php echo site_url('recruitment/detail/' . $item['slug']); ?>">
                    <h2 class="headline"><?php echo $item['title']; ?></h2>
                </a>

                <p><?php echo $item['description']; ?></p>
                <a class="btn btn-default btn-fill" href="<?php echo site_url('recruitment/detail/' . $item['slug']); ?>" role="button">
                    <?php echo $this->lang->line('read_more') ?>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/css/blogs.css'); ?>">

<section class="main-content container">

    <div id="news-content">
        <?php if($articles): ?>
        <?php foreach($articles as $key => $item): ?>
        <div class="row">
            <div class="news-img col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <img src="<?php echo base_url('assets/upload/article/' . $item['description_image']); ?>">
            </div>
            <div class="news-intro col-lg-5 col-md-5 col-sm-5 col-xs-12">

                <h2 class="headline"><?php echo $item['title']; ?></h2>

                <p><?php echo $item['description']; ?></p>
                <a class="btn btn-default btn-fill" href="<?php echo site_url('article/detail/' . $item['article_id']); ?>" role="button">
                    <?php echo $this->lang->line('read_more') ?>
                </a>
            </div>
            <?php if($item['type'] == 0): ?>
            <div class="right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <table>
                    <tr>
                        <td><i class="fa fa-2x fa-clock-o"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['event_time']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-map-marker"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['event_location']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-location-arrow"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['event_address']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-money"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['event_cost']; ?></td>
                    </tr>
                </table>
            </div>
            <?php else: ?>
            <div class="right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <table>
                    <tr>
                        <td><i class="fa fa-2x fa-clock-o"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['created_at']; ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-user"></i></td>
                        <td>&nbsp;</td>
                        <td><?php echo $item['created_by']; ?></td>
                    </tr>
                </table>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>


    </div>
</section>
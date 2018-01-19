<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">

    <div id="news-content">
        <?php if($news): ?>
        <?php foreach($news as $key => $item): ?>
        <div class="row">
            <div class="news-img col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <img src="<?php echo base_url('assets/upload/article/' . $item['description_image']); ?>">
            </div>
            <div class="left col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="content-title">
                    <h2><?php echo $item['title']; ?></h2>
                </div>
                <p><?php echo $item['description']; ?></p>
                <a class="btn btn-default btn-fill" href="<?php echo site_url('article/detail/' . $item['article_id']); ?>" role="button">
                    <?php echo $this->lang->line('read_more') ?>
                </a>
            </div>
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
        </div>
        <?php endforeach; ?>
        <?php endif; ?>


    </div>
</section>
<!-- InstanceBeginEditable name="content" -->

<section class="main-content container" id="project">
    <div class="row">
        <div class="navside col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="content-title">
                <h2><?php echo $this->lang->line('library_title'); ?></h2>
                <div class="title-underline"></div>
            </div>
            <ul>
                <li><a class="filter" data-filter="*"><?php echo $this->lang->line('library_all'); ?></a></li>
<!--                <li><a class="filter" data-filter=".teach">--><?php //echo $this->lang->line('library_teach'); ?><!--</a></li>-->
<!--                <li><a class="filter" data-filter=".study">--><?php //echo $this->lang->line('library_learn'); ?><!--</a></li>-->
<!--                <li><a class="filter" data-filter=".life">--><?php //echo $this->lang->line('library_live'); ?><!--</a></li>-->
<!--                <li><a class="filter" data-filter=".book">--><?php //echo $this->lang->line('library_book'); ?><!--</a></li>-->
                <li><a class="filter" data-filter=".video"><?php echo $this->lang->line('library_video'); ?></a></li>
                <li><a class="filter" data-filter=".image"><?php echo $this->lang->line('library_image'); ?></a></li>
                <li><a class="filter" data-filter=".study"><?php echo $this->lang->line('library_study'); ?></a></li>
                <li><a class="filter" data-filter=".share"><?php echo $this->lang->line('library_share'); ?></a></li>
            </ul>
        </div>

        <div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="grid">
                <div class="grid-sizer"></div>
                <?php
                    $type = array(
                        //0 => 'teach',
                        //1 => 'study',
                        //2 => 'life',
                        //3 => 'book'
                        0 => 'video',
                        1 => 'image',
                        2 => 'study',
                        3 => 'share'
                    );
                ?>
                <?php if($libraries): ?>
                <?php foreach($libraries as $item): ?>
                <div class="grid-item all <?php echo $type[$item['type']]; ?>">
                    <div class="inner">
                        <img src="<?php echo base_url('assets/upload/library/' . $item['description_image']); ?>">
                        <a href="<?php echo site_url('library/detail/' . $item['slug']); ?>">
                            <label><?php echo $item['title']; ?></label>
                        </a>
                        <p><?php echo $item['description']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>



</section>

<!-- InstanceEndEditable -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo site_url('assets/public/js/isotope.pkgd.min.js'); ?>"></script>
<script>
    $('.grid').isotope({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
            // use element for option
            columnWidth: '.grid-sizer'
        }
    })

    var $grid = $('.grid').isotope({
        // options
    });
    $('.navside li').on( 'click', 'a', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });
    $grid.imagesLoaded().progress( function() {
        $grid.isotope('layout');
    });
</script>
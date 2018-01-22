<!-- InstanceBeginEditable name="content" -->

<section class="main-content container" id="project">
    <div class="row">
        <div class="navside col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="content-title" style="margin-bottom:0px !important">
                <h2><?php echo $this->lang->line('library'); ?></h2>
                <div class="title-underline"></div>
            </div>
            <ul class="list-unstyled">
                <li>
                    <a href="<?php echo site_url('library'); ?>"><?php echo $this->lang->line('lessons'); ?></a>
                </li>
                <li>
                    <a href="<?php echo site_url('video'); ?>">Video</a>
                </li>
            </ul>
        </div>

        <div class="content col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <?php if($videos): ?>
                <?php foreach($videos as $item): ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <iframe src="<?php echo $item['url']; ?>" frameborder="0" allowfullscreen style="width:100%;"></iframe>
                            <label><?php echo $item['title']; ?></label>
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
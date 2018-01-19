<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
    <div class="cover">
        <img src="img/cover-100.jpg">
    </div>
    <div class="news-post">
        <div class="row">
            <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="content-title">
                    <h2><?php echo $category; ?></h2>
                    <div class="title-underline"></div>
                </div>

                <h1><?php echo $article['article_title']; ?></h1>
                <?php echo $article['article_content']; ?>
            </div>
            <?php if($article['type'] == 1): ?>
            <div class="right col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="content-title">
                    <h2>Categories</h2>
                    <div class="title-underline"></div>
                </div>
                <ul>
                    <?php if($list_categories): ?>
                        <?php foreach($list_categories as $item): ?>
                            <li><a href="<?php echo site_url('article/news/' . $item['category_id']); ?>"><?php echo $item['title']; ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>

    </div>



</section>

<!-- InstanceEndEditable -->
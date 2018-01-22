<!doctype html>
<html><!-- InstanceBegin template="Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
    <!-- InstanceEndEditable -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/libraries/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/libraries/css/font-awesome.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/libraries/css/hover.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/libraries/css/responsive.css'); ?>">
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/public/libraries/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo site_url('assets/public/js/script.js'); ?>"></script>
</head>

<body>
<header class="header">
    <?php
    $url_en = '';
    $url_vi = '';

    switch($current_link){
        case 'introduce':
            $url_en = base_url() . 'en/' . 'introduce';
            $url_vi = base_url() . 'vi/' . 'introduce';
            break;
        case 'why_us':
            $url_en = base_url() . 'en/' . 'introduce/why_us';
            $url_vi = base_url() . 'vi/' . 'introduce/why_us';
            break;
        case 'study_path':
            $url_en = base_url() . 'en/' . 'introduce/study_path';
            $url_vi = base_url() . 'vi/' . 'introduce/study_path';
            break;
        case 'message':
            $url_en = base_url() . 'en/' . 'introduce/message';
            $url_vi = base_url() . 'vi/' . 'introduce/message';
            break;
        case 'vision':
            $url_en = base_url() . 'en/' . 'introduce/vision';
            $url_vi = base_url() . 'vi/' . 'introduce/vision';
            break;
        case 'teachers':
            $url_en = base_url() . 'en/' . 'introduce/teachers';
            $url_vi = base_url() . 'vi/' . 'introduce/teachers';
            break;
        case 'detail_teacher':
            $url_en = base_url() . 'en/' . 'introduce/detail_teacher/' . $teacher_slug_en;
            $url_vi = base_url() . 'vi/' . 'introduce/detail_teacher/' . $teacher_slug_vi;
            break;
        case 'partners':
            $url_en = base_url() . 'en/' . 'introduce/partners';
            $url_vi = base_url() . 'vi/' . 'introduce/partners';
            break;
        case 'detail_partner':
            $url_en = base_url() . 'en/' . 'introduce/detail_partner/' . $partner_slug_en;
            $url_vi = base_url() . 'vi/' . 'introduce/detail_partner/' . $partner_slug_vi;
            break;
            
        case 'list_project':
            $url_en = base_url() . 'en/' . 'project';
            $url_vi = base_url() . 'vi/' . 'project';
            break;
        case 'detail_project':
            $url_en = base_url() . 'en/' . 'project/detail/' . $project_slug_en;
            $url_vi = base_url() . 'vi/' . 'project/detail/' . $project_slug_vi;
            break;
        case 'training_seven_steps':
            $url_en = base_url() . 'en/' . 'training/training_seven_steps';
            $url_vi = base_url() . 'vi/' . 'training/training_seven_steps';
            break;
        case 'training_seven_steps':
            $url_en = base_url() . 'en/' . 'training/training_high_class';
            $url_vi = base_url() . 'vi/' . 'training/training_high_class';
            break;
        case 'training_seven_steps':
            $url_en = base_url() . 'en/' . 'training/training_middle_class';
            $url_vi = base_url() . 'vi/' . 'training/training_middle_class';
            break;
        case 'training_seven_steps':
            $url_en = base_url() . 'en/' . 'training/training_people';
            $url_vi = base_url() . 'vi/' . 'training/training_people';
            break;
        case 'list_advice':
            $url_en = base_url() . 'en/' . 'advice';
            $url_vi = base_url() . 'vi/' . 'advice';
            break;
        case 'detail_advice':
            $url_en = base_url() . 'en/' . 'advice/detail/' . $advice_slug_en;
            $url_vi = base_url() . 'vi/' . 'advice/detail/' . $advice_slug_vi;
            break;
        case 'list_article':
            $url_en = base_url() . 'en/' . 'article';
            $url_vi = base_url() . 'vi/' . 'article';
            break;
        case 'detail_article':
            $url_en = base_url() . 'en/' . 'article/detail/' . $article_slug_en;
            $url_vi = base_url() . 'vi/' . 'article/detail/' . $article_slug_vi;
            break;
        case 'list_news':
            $url_en = base_url() . 'en/' . 'article/news/' . $category_id;
            $url_vi = base_url() . 'vi/' . 'article/news/' . $category_id;
            break;
        case 'list_recruitment':
            $url_en = base_url() . 'en/' . 'recruitment';
            $url_vi = base_url() . 'vi/' . 'recruitment';
            break;
        case 'detail_recruitment':
            $url_en = base_url() . 'en/' . 'recruitment/detail/' . $recruitment_slug_en;
            $url_vi = base_url() . 'vi/' . 'recruitment/detail/' . $recruitment_slug_vi;
            break;
        case 'list_library':
            $url_en = base_url() . 'en/' . 'library';
            $url_vi = base_url() . 'vi/' . 'library';
            break;
        case 'detail_library':
            $url_en = base_url() . 'en/' . 'library/detail/' . $library_slug_en;
            $url_vi = base_url() . 'vi/' . 'library/detail/' . $library_slug_vi;
            break;
        case 'contact':
            $url_en = base_url() . 'en/' . 'contact';
            $url_vi = base_url() . 'vi/' . 'contact';
            break;
        default:
            $url_en = base_url() . 'en';
            $url_vi = base_url() . 'vi';
            break;
    }
    ?>
    <section class="topnav container">
        <div class="row">
            <div class="logo col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/public/img/logo.png'); ?>">
                </a>
            </div>
            <div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
                <nav class="nav hidden-xs hidden-sm">
                    <ul>
                        <li><a href="<?php echo site_url('introduce'); ?>"><?php echo $this->lang->line('introduce'); ?></a></li>
                        <li><a href="<?php echo site_url('project'); ?>"><?php echo $this->lang->line('training'); ?></a></li>
                        <li><a href="<?php echo site_url('advice'); ?>"><?php echo $this->lang->line('advice'); ?></a></li>
                        <li><a href="<?php echo site_url('article'); ?>"><?php echo $this->lang->line('events'); ?></a></li>
                        <li><a href="<?php echo site_url('recruitment'); ?>"><?php echo $this->lang->line('recruitment'); ?></a></li>
                        <li>
                            <a href=""><?php echo $this->lang->line('library'); ?> </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?php echo site_url('library'); ?>"><?php echo $this->lang->line('lessons'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('video'); ?>">Video</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('contact'); ?></a></li>
                    </ul>
                </nav>
            </div>
            <div class="topnav-right col-lg-2 col-md-2 hidden-sm hidden-xs">
                <div class="search">
                    <input type="text" class="form-control" id="inputSearch" placeholder="Tìm kiếm">
                </div>
                <div class="language">
                    <a href="<?php echo $url_en; ?>">e</a> | <a href="<?php echo $url_vi; ?>">V</a>
                </div>
                <div class="quickcall">
                    <table>
                        <tr>
                            <td><i class="fa fa-2x fa-phone"></i></td>
                            <td>
                                <h4><?php echo $this->lang->line('index_quickcall'); ?></h4>
                                <h4>0909 865 689</h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="expandnav hidden-lg hidden-md col-sm-8 col-xs-6">
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-3x fa-bars"></i>
                </a>
            </div>
        </div>
        <div class="row">

            <div class="nav-expand container center-block">
                <div class="collapse" id="collapseExample">
                    <div class="well">
                        <ul>
                            <li><a href="<?php echo site_url('introduce'); ?>"><?php echo $this->lang->line('introduce'); ?></a></li>
                            <li><a href="<?php echo site_url('training'); ?>"><?php echo $this->lang->line('training'); ?></a></li>
                            <li><a href="<?php echo site_url('advice/index/1'); ?>"><?php echo $this->lang->line('advice'); ?></a></li>
                            <li><a href="<?php echo site_url('article'); ?>"><?php echo $this->lang->line('events'); ?></a></li>
                            <li><a href="<?php echo site_url('recruitment'); ?>"><?php echo $this->lang->line('recruitment'); ?></a></li>
                            <li>
                                <a href="<?php echo site_url('library'); ?>"><?php echo $this->lang->line('library'); ?></a>
                                <ul class="">
                                    <li>
                                        <a href="<?php echo site_url('library'); ?>"><?php echo $this->lang->line('lessons'); ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('video'); ?>">Video</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="<?php echo site_url('contact'); ?>"><?php echo $this->lang->line('contact'); ?></a></li>
                            <li><a href="<?php echo $url_en; ?>">e</a> | <a href="<?php echo $url_vi; ?>">V</a></li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
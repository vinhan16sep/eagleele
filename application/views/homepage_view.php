<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/public/css/homepage.css'); ?>">

<section class="">
    <div id="index-slide" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#index-slide" data-slide-to="0" class="active"></li>
            <li data-target="#index-slide" data-slide-to="1"></li>
            <li data-target="#index-slide" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php if($banners): ?>
                <?php foreach($banners as $key => $item): ?>
                    <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>">
                        <a href="<?php echo $item['url']; ?>"><img src="<?php echo base_url('assets/upload/banner/' . $item['image']); ?>" alt="<?php echo $item['text']; ?>"></a>
                        <!--<div class="carousel-caption">
                        <?php echo $item['text']; ?>
                    </div>-->
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#index-slide" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#index-slide" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<section class="container-fluid">
    <div class="main-content container">
        <div class="" id="index-about">
            <div class="shadow">
                <div class="row">
                    <div class="index-about col-md-8 col-sm-8 col-xs-12">
                        <div class="content-title">
                            <h2><?php echo $this->lang->line('index_about_us'); ?></h2>
                            <div class="title-underline"></div>
                        </div>
                        <?php if($lang == 'vi'): ?>
                            <p>Công ty cổ phần EAGLE ELE, tên thương hiệu EAGLE ELE được thành lập và vận hành bởi những chuyên gia có nhiều năm kinh nghiệm chuyên môn thực tiễn, có kỹ năng chuyên sâu về công nghệ truyền thông, dịch vụ đào tạo và tham vấn tư vấn cùng đam mê, nhiệt huyết chia sẻ.</p>
                        <?php elseif($lang == 'en'): ?>
                            <p>EAGLE ELE company is established and operated by professionals with years of professional experience, specialized in communications technology, training and consulting services. consultant with passion, enthusiasm share.</p>
                        <?php  endif; ?>
                    </div>

                    <div class="index-about col-md-4 col-sm-4 col-xs-12">
                        <a href="<?php echo site_url('introduce'); ?>"><img src="<?php echo base_url('assets/public/img/logo.png'); ?>"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="index-course col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('index_event'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <div class="row">
                    <?php for($i = 0; $i < 3; $i++) { ?>
                        <?php if(isset($events[$i])): ?>
                            <div class="index-coach-left-item col-md-4 col-sm-12 col-xs-12">
                                <img src="<?php echo base_url('assets/upload/article/' . $events[$i]['description_image']); ?>">
                                <a href="<?php echo site_url('article/detail/' . $events[$i]['article_id']); ?>"><label> <?php echo $events[$i]['title']; ?></label></a>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="index-side col-lg-4 col-md-4 hidden-sm hidden-xs">
                <div class="shadow">
                    <?php if(isset($video[0])): ?>
                    <div class="content-title">
                        <h2>Video</h2>
                        <div class="title-underline"></div>
                    </div>
                    <div class="index-video">
                        <!--
                            Allow embed a youtube video into homepage, change link in src. All style fixed.
                        -->

                        <iframe src="<?php echo $video[0]['url']; ?>" frameborder="0" allowfullscreen></iframe>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="index-coach col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('index_coach'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <div class="row">
                        <div class="index-coach-left col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <?php for($i = 0; $i < 4; $i++) { ?>
                                <?php if(isset($teachers[$i])): ?>
                                    <div class="index-coach-left-item col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <img src="<?php echo base_url('assets/upload/teacher/' . $teachers[$i]['description_image']); ?>">
                                        <a href="<?php echo site_url('introduce/detail_teacher/' . $teachers[$i]['teacher_id']); ?>"><label> <?php echo $teachers[$i]['name']; ?></label></a>
                                        <p><?php echo $teachers[$i]['position']; ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                        <div class="index-coach-right col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <?php if($lang == 'vi'): ?>
                            <label class="quote"> "Chúng tôi có những chuyên gia giỏi nhất"</label>
                            <p>Chúng tôi hợp tác với các chuyên gia kinh tế, các tổ chức nghiên cứu thị trường để có được những thông tin chính xác về thị trường nghiên cứu, lập kế hoạch, phát triển và thực hiện chiến lược tăng trưởng hiệu quả! </p>
                            <?php elseif($lang == 'en'): ?>
                            <label class="quote"> "We have the best experts"</label>
                            <p>We cooperate with economic experts and market research organizations to get accurate information about market research, planning, development and implementation of effective growth strategies!</p>
                            <?php  endif; ?>
                            <a class="btn btn-default btn-fill" href="<?php echo site_url('introduce/teachers'); ?>" role="button">
                                <?php echo $this->lang->line('index_read_more'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('index_clients'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <div id="index-customers" class="carousel slide slide-customers" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#index-customers" data-slide-to="0" class="active"></li>
                            <li data-target="#index-customers" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-01.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-02.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-03.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-04.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-05.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-06.png'); ?>">
                                    </a>
                                </div>
                            </div>

                            <div class="item">
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-07.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-08.png'); ?>">
                                    </a>
                                </div>
                                <div class="index-books-item col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <a href="#">
                                        <img src="<?php echo base_url('assets/public/img/logo-client-09.png'); ?>">
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="index-news col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('library'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <ul>
                        <?php if($libraries): ?>
                            <?php foreach($libraries as $item): ?>
                                <li>
                                    <a href="<?php echo site_url('article/detail/' . $item['library_id']); ?>"><?php echo $item['title']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="index-news col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('index_news'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <ul>
                        <?php if($news): ?>
                        <?php foreach($news as $item): ?>
                            <li>
                                <a href="<?php echo site_url('article/detail/' . $item['article_id']); ?>"><?php echo $item['title']; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="index-comment col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="shadow">
                    <div class="content-title">
                        <h2><?php echo $this->lang->line('index_student_thinking'); ?></h2>
                        <div class="title-underline"></div>
                    </div>
                    <div id="index-comment" class="carousel slide slide-comment" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#index-comment" data-slide-to="0" class="active"></li>
                            <li data-target="#index-comment" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="index-comment-item">
                                    <div class="left">
                                        <img src="<?php echo base_url('assets/public/img/student-2.jpg'); ?>">
                                    </div>
                                    <div class="right">
                                        <?php if($lang == 'vi'): ?>
                                        <p>Tôi nhận được những giá trị vượt xa so với học phí, học xong giúp ích ngay cho công việc của tôi.</p>
                                        <p class="note">
                                            Ngọc Anh <br>
                                            Trưởng phòng Thiết kế Mato
                                        </p>
                                        <?php elseif($lang == 'en'): ?>
                                        <p>I get the value far beyond the tuition fee, learning to help immediately for my work.</p>
                                        <p class="note">
                                            Ngoc Anh <br>
                                            Head of Design Department Mato
                                        </p>
                                        <?php  endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="index-comment-item">
                                    <div class="left">
                                        <img src="<?php echo base_url('assets/public/img/student-1.jpg'); ?>">
                                    </div>
                                    <div class="right">
                                        <?php if($lang == 'vi'): ?>
                                        <p>Việc tương tác thường xuyên, chia sẻ cởi mở về bí quyết làm nghề và những ví dụ rất sát với thực tế giúp mình ứng dụng ngay cho công việc.</p>
                                        <p class="note">
                                            Nguyễn Minh Quang <br>
                                            Art Director Mato Creative
                                        </p>
                                        <?php elseif($lang == 'en'): ?>
                                        <p>Frequent interaction, open sharing of know-how and examples are close to reality to help you immediately apply for work.</p>
                                        <p class="note">
                                            Nguyen Minh Quang <br>
                                            Art Director Mato Creative
                                        </p>
                                        <?php  endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="dangkykhoahoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Đăng ký khóa học</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Thông tin khóa học</h3>
                        <form>
                            <div class="form-group">
                                <label for="inputCourse">Lựa chọn khóa học</label>
                                <select class="form-control">
                                    <option>--Lựa chọn khóa học--</option>
                                    <option>Khóa học I</option>
                                    <option>Khóa học II</option>
                                    <option>Khóa học III</option>
                                    <option>Khóa học IV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputCourseFee">Gói học phí</label>
                                <select class="form-control">
                                    <option>--Lựa chọn gói học phí--</option>
                                    <option>Gói I</option>
                                    <option>Gói II</option>
                                    <option>Gói III</option>
                                    <option>Gói IV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputLocation">Địa điểm</label>
                                <select class="form-control">
                                    <option>Hà Nội</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputLocation">Thời gian</label>
                                <input type="date" class="form-control" id="inputDate">
                            </div>
                        </form>

                        <h3>Thông tin học viên</h3>
                        <div id="addHere">
                            <form id="student">
                                <div class="form-group">
                                    <label for="inputSex">Quý danh</label>
                                    <select class="form-control">
                                        <option>Ông</option>
                                        <option>Bà</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Họ và tên</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Họ và tên">
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone">Điện thoại</label>
                                    <input type="number" class="form-control" id="inputPhone" placeholder="Điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="inputMail">Email</label>
                                    <input type="number" class="form-control" id="inputMail" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="inputCompany">Công ty</label>
                                    <input type="text" class="form-control" id="inputCompany" placeholder="Công ty">
                                </div>
                                <div class="form-group">
                                    <label for="inputStage">Chức vụ</label>
                                    <input type="text" class="form-control" id="inputStage" placeholder="Chức vụ">
                                </div>
                            </form>
                        </div>

                        <h3>Thông tin thêm</h3>
                        <form>
                            <div class="form-group">
                                <label for="inputCourse">Bạn biết đến khóa học qua</label>
                                <select class="form-control">
                                    <option>--Lựa chọn hình thức--</option>
                                    <option>Facebook</option>
                                    <option>Quảng cáo</option>
                                    <option>Tờ rơi</option>
                                    <option>Bạn bè</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputCourseFee">Loại hình thanh toán</label>
                                <select class="form-control">
                                    <option>--Lựa chọn hình thức--</option>
                                    <option>Tiền mặt</option>
                                    <option>Chuyển khoản</option>
                                    <option>Nợ</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4>ĐỂ ĐĂNG KÝ KHÓA HỌC XIN VUI LÒNG LIÊN HỆ TRỰC TIẾP</h4>
                        <ul>
                            <li>Địa chỉ: Đường abc, xyz, Hà Nội</li>
                            <li>Email: mail@eagleele.vn</li>
                            <li>Hotline: +84 1234 5678</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" id="addStudent" class="btn btn-default">Thêm người đăng ký</button>
                <button type="button" class="btn btn-primary btn-fill">Đăng ký</button>
            </div>
        </div>
    </div>
</div>

<!-- InstanceEndEditable -->
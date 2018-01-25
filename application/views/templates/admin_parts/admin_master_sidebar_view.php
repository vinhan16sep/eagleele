<?php
if($this->ion_auth->logged_in()) {
    ?>
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/background'); ?>" class="">
                        <span>Background</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/banner'); ?>" class="">
                        <span>Banner</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/intro'); ?>" class="">
                        <span>Intro</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/teacher'); ?>" class="">
                        <span>Giảng viên</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/project'); ?>" class="">
                        <span>Dự án đào tạo</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/partner'); ?>" class="">
                        <span>Đối tác</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/advice'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Tư vấn</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/article'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Bài viết</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/recruitment'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Tuyển dụng</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/library'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Thư viện</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/video'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Video Youtube</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/testimonial'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Ý kiến học viên</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('admin/contact'); ?>" class="">
                        <i class="icon_document_alt"></i>
                        <span>Liên hệ</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
<?php } ?>




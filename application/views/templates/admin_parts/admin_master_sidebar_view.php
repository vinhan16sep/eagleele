<?php
if($this->ion_auth->logged_in()) {
?>
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="sub-menu">
                <a href="<?php echo site_url('admin/recruitment'); ?>" class="">
                    <i class="icon_document_alt"></i>
                    <span>Tuyển dụng</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:void(0);" class="">
                    <i class="icon_document_alt"></i>
                    <span>Giới thiệu</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="<?php echo site_url('admin/teacher'); ?>" class="">
                    <span>Giảng viên</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="<?php echo site_url('admin/banner'); ?>" class="">
                    <span>Banner</span>
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
                <a href="<?php echo site_url('admin/library'); ?>" class="">
                    <i class="icon_document_alt"></i>
                    <span>Thư viện</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<?php } ?>



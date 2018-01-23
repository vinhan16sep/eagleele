<footer class="container-fluid">
    <div class="container center-block">
        <div class="row">
            <div class="left col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="content-title">
                    <h2><?php echo $this->lang->line('footer_title'); ?></h2>
                </div>
                <table>
                    <tr>
                        <td><i class="fa fa-2x fa-map-marker"></i></td>
                        <td><?php echo $this->lang->line('footer_adress'); ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-envelope-o"></i></td>
                        <td>info@eagleele.vn</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-2x fa-phone"></i></td>
                        <td>+84 909 865 689</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-3 col-md-4 hidden-sm hidden-xs">
            </div>
            <div class="right col-lg-5 col-md-4 col-sm-6 col-xs-12">
                <table>
                    <tr>
                        <td><img src="<?php echo base_url('assets/public/img/logo-w.png'); ?>"></td>
                        <td>
                            <ul>
                                <li><a href="#"><i class="fa fa-2x fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-2x fa-youtube-square"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">2017 Copyright</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</footer>

<div class="fixed">
    <ul class="list-unstyled list-inline">
        <li><i class="fa fa-chevron-up fa-2x scrollup" data-toggle="tooltip" data-placement="top" title="Trở về đầu trang"></i></li>
        <li><i class="fa fa-comment-o fa-2x chatbox" data-toggle="tooltip" data-placement="top" title="Gửi tin nhắn"></i></li>
        <li>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FEAGLEELE%2F&tabs=messages&width=300&height=300&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=504743766549751" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </li>
    </ul>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="introModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo $popup_content['intro_content']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
<script>
    <?php if($show_intro_popup == 1): ?>
        //$('#introModal').modal('show');
    <?php endif; ?>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>
<script src="<?php site_url('assets/public/js/facebook_chat.js') ?>"></script>
<!-- InstanceBeginEditable name="addition" -->
<!-- InstanceEndEditable -->
<!-- InstanceEnd --></html>
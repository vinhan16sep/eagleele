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
<div class="scrollup">
    <i class="fa fa-chevron-up fa-3x"></i>
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
        $('#introModal').modal('show');
    <?php endif; ?>
</script>
<!-- InstanceBeginEditable name="addition" -->
<!-- InstanceEndEditable -->
<!-- InstanceEnd --></html>
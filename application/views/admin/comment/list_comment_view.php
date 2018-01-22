<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        <div class="container col-md-12">
            <h3 style="text-transform: uppercase; text-align: center;">
                Bình luận cho bài viết: <span style="color: #0e90d2"><?php echo $title ?></span>
            </h3>
            <div>
                <span><?php echo $this->session->flashdata('message'); ?></span>
            </div>
            <?php if ($list_comment): ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        <table class="table table-hover table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 150px"><b><a href="#">Email</a></b></td>
                                    <td style="width: 100px"><b><a href="#">Họ tên</a></b></td>
                                    <td><b><a href="#">Nội dung</a></b></td>
                                    <td style="width: 100px"><b>Operations</b></td>
                                </tr>
                                <?php foreach ($list_comment as $key => $value): ?>
                                    <tr class="row_<?php echo $value['id'] ?>">
                                        <td><?php echo $value['email'] ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td><?php echo $value['content'] ?></td>
                                        <td>
                                            <form class="form_ajax">
                                                <a href="<?php echo base_url('admin/comment/remove') ?>" title="Xóa" class="btn-remove" data-id="<?php echo $value['id'] ?>" >
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="col-md-6 col-md-offset-5 page">
                            <!-- <?php echo $page_links ?> -->
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 10px;">
                        không tồn tại!
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>
</div>
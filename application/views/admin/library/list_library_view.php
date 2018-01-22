<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
    <div class="row">
        <a type="button" href="<?php echo site_url('admin/library/create'); ?>" class="btn btn-primary">ADD NEW</a>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Title</a></b></td>';
            echo '<td><b><a href="#">Type</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($libraries)) {
                foreach ($libraries as $item):
                    echo '<tr>';
                    echo '<td>' . $item['title'][0] . '|' . $item['title'][1] . '</td>';
                    ?>
                    <?php
                    $type = '';
                    switch($item['type'][0]){
                        case 0:
                            $type = 'Video';
                            break;
                        case 1:
                            $type = 'Hình ảnh';
                            break;
                        case 2:
                            $type = 'Bài học';
                            break;
                        case 3:
                            $type = 'Chia sẻ';
                            break;
                    }
                    ?>
                    <td><span><?php echo $type; ?></span></td>
                    <?php
                    echo '<td>' . anchor('admin/comment/index/library/' . $item['library_id'][0], '<span class="glyphicon glyphicon-comment"></span>');
                    echo '' . anchor('admin/library/edit/' . $item['library_id'][0], '<span class="glyphicon glyphicon-pencil"></span>');
                    echo ' ' . anchor('admin/library/delete/' . $item['library_id'][0], '<span class="glyphicon glyphicon-remove"></span>') . '</td>';
                    echo '</tr>';
                endforeach;
            }else {
                echo '<tr class="odd"><td colspan="9">No records</td></tr>';
            }
            echo '</table>';
            ?>
            <div class="col-md-6 col-md-offset-5">
                <?php echo $page_links; ?>
            </div>
        </div>
    </div>  
</div>

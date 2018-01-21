<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    table img{
        width:500px;
    }
</style>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
    <div class="row">
        <a type="button" href="<?php echo site_url('admin/video/create'); ?>" class="btn btn-primary">ADD NEW</a>
        <a type="button" class="btn btn-danger disabled">DELETE ALL SELECTED ITEM</a>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Title</a></b></td>';
            echo '<td><b><a href="#">Url</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($videos)) {
                foreach ($videos as $item):
                    echo '<tr>';
                    echo '<td>' . $item['title'] . '</td>';
                    echo '<td>' . $item['url'] . '</td>';
                    echo '<td>' . anchor('admin/video/edit/' . $item['id'], '<span class="glyphicon glyphicon-pencil"></span>');
                    echo ' ' . anchor('admin/video/delete/' . $item['id'], '<span class="glyphicon glyphicon-remove"></span>') . '</td>';
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

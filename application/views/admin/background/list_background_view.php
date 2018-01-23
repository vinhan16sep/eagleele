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
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Image</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($backgrounds)) {
                foreach ($backgrounds as $item):
                    echo '<tr>';
                    echo '<td><img src="' . site_url('assets/upload/background/' . $item['image']) . '" /></td>';
                    echo '<td>';
                    echo ' ' . anchor('admin/background/edit/' . $item['id'], '<span class="glyphicon glyphicon-pencil"></span>') . '</td>';
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

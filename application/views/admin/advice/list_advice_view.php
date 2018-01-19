<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
    <div class="row">
        <a type="button" href="<?php echo site_url('admin/teacher/create'); ?>" class="btn btn-primary">ADD NEW</a>
        <a type="button" class="btn btn-danger disabled">DELETE ALL SELECTED ITEM</a>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><input type="checkbox" class="check-all" id="check-all" /></td>';
            echo '<td><b><a href="#">Title</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($advices)) {
                foreach ($advices as $item):
                    echo '<tr>';
                    echo '<td><input type="checkbox" class="checkbox" name="checkbox[' . $item['advice_id'][0] . ']" value="' . $item['advice_id'][0] . '" /></td>';
                    echo '<td>' . $item['title'][0] . '|' . $item['title'][1] . '</td>';
                    echo '<td>' . anchor('admin/advice/edit/' . $item['advice_id'][0], '<span class="glyphicon glyphicon-pencil"></span>');
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

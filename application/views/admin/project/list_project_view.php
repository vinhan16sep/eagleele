<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>

    <div class="row">
        <a type="button" href="<?php echo site_url('admin/project/create'); ?>" class="btn btn-primary">ADD PROJECT</a>
<!--    --><?php //echo form_open_multipart(); ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Title</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($projects)) {
                foreach ($projects as $item):
                    echo '<tr>';
                        echo '<td>' . str_replace('|||', ' | ', $item['data']['project_title']) . '</td>';
                        echo '<td>';
                        echo anchor('admin/comment/index/project/' . $item['id'], '<span class="glyphicon glyphicon-comment"></span>');
                        echo '<a href="' . base_url('admin/project/edit/' . $item['id']) . '">';
                        echo '<span class="glyphicon glyphicon-pencil"></span>';
                        echo '</a>';
                        echo '<a href="javascript:void(0);" onclick="deleteItem(' . $item['id'] . ')">';
                        echo '<span class="glyphicon glyphicon-remove"></span>';
                        echo '</a>';
                        echo '</td>';
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
<!--    --><?php //echo form_close(); ?>
</div>
<script>
    function deleteItem(id){
        if(confirm('Chắc chắn xoá?')){
            var url = '<?php echo base_url('admin/project/delete'); ?>';

            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(res){
                    console.log(res);
                    if(res.message == 'Success'){
                        alert('Xoá thành công');
                        location.reload();
                    }else{
                        alert('Xoá thất bại');
                    }
                },
                error: function(){

                }
            });
        }
    }
</script>

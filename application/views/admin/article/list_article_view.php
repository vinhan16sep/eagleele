<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
    <div class="row">
        <a type="button" href="<?php echo site_url('admin/article/create'); ?>" class="btn btn-primary">ADD NEW</a>
        <a type="button" class="btn btn-danger disabled">DELETE ALL SELECTED ITEM</a>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Title</a></b></td>';
            echo '<td><b><a href="#">Category</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($articles)) {
                foreach ($articles as $item):
                    echo '<tr>';
                    echo '<td>' . str_replace('|||', ' | ', $item['data']['article_title']) . '</td>';
                    ?>
                    <td><span><?php echo ($item['data']['type'][0] == 0) ? 'Event' : 'News' ?></span></td>
                    <?php
                    echo '<td>';
                    echo anchor('admin/comment/index/article/' . $item['id'], '<span class="glyphicon glyphicon-comment"></span>');
                    echo '<a href="' . base_url('admin/article/edit/' . $item['id']) . '">';
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
</div>
<script>
    function deleteItem(id){
        if(confirm('Chắc chắn xoá?')){
            var url = '<?php echo base_url('admin/article/delete'); ?>';

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

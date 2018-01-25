<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
    <div class="row">
        <a type="button" href="<?php echo site_url('admin/testimonial/create'); ?>" class="btn btn-primary">ADD NEW</a>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Ảnh</a></b></td>';
            echo '<td><b><a href="#">Họ tên</a></b></td>';
            echo '<td><b><a href="#">Chức danh</a></b></td>';
            echo '<td><b><a href="#">Nội dung</a></b></td>';
            echo '<td><b>Operations</b></td>';
            echo '</tr>';
            if (!empty($testimonials)) {
                foreach ($testimonials as $item):
                    echo '<tr class="row_'.$item['id'].'">';
                    echo '<td>' . '<img src="'. base_url('assets/upload/testimonial/' . $item['image']) .'" alt="" width="150">' . '</td>';
                    echo '<td>' . str_replace('|||', ' | ', $item['name']) . '</td>';
                    echo '<td>' . str_replace('|||', ' | ', $item['position']) . '</td>';
                    echo '<td>' . str_replace('|||', ' | ', $item['content']) . '</td>';
                    echo '<td>';
                    echo '<a href="' . base_url('admin/testimonial/edit/' . $item['id']) . '">';
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
            var url = '<?php echo base_url('admin/testimonial/remove'); ?>';

            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(res){
                    console.log(res.isExist);
                    if(res.isExist == true){
                        $('.row_'+ id).fadeOut();
                    }
                },
                error: function(){

                }
            });
        }
    }
</script>

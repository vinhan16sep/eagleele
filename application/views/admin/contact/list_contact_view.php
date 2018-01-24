<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <span><?php echo $this->session->flashdata('message'); ?></span>
    </div>
<!--    <div class="row">-->
<!--        <a type="button" href="--><?php //echo site_url('admin/advice/create'); ?><!--" class="btn btn-primary">ADD NEW</a>-->
<!--    </div>-->
    <div class="row">
        <h4>Liên Hệ</h4>
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            echo '<table class="table table-hover table-bordered table-condensed">';
            echo '<tr>';
            echo '<td><b><a href="#">Họ Tên</a></b></td>';
            echo '<td><b><a href="#">Email</a></b></td>';
            echo '<td><b><a href="#">Số Điện Thoại</a></b></td>';
            echo '<td width="25%"><b><a href="#">Lý Do</a></b></td>';
            echo '<td><b><a href="#">Tin nhắn</a></b></td>';
            echo '</tr>';
            if (!empty($contacts)) {
                foreach ($contacts as $item):
                    echo '<tr>';
                    echo '<td>' . str_replace('|||', ' | ', $item['name']) . '</td>';
                    echo '<td>' . str_replace('|||', ' | ', $item['email']) . '</td>';
                    echo '<td>' . str_replace('|||', ' | ', $item['phone']) . '</td>';
                    ?>
                    <td>
                        <?php
                            switch ($item['reason']){
                                case '1':
                                    echo 'Bạn đang cần liên hệ với chúng tôi vì.../ What do you need?';
                                    break;
                                case '2':
                                    echo 'Tôi đang cần tư vấn khóa học / I need advice about study';
                                    break;
                                case '3':
                                    echo 'Tôi đang cần 1 việc làm / I need a job';
                                    break;
                                case '4':
                                    echo 'Tôi muốn tìm hiểu về ABC / I want research ABC';
                                    break;
                                case '5':
                                    echo 'Tôi muốn tìm hiểu về DEF / I want research DEF';
                                    break;
                            }
                        ?>
                    </td>
                    <?php
                    echo '<td>' . str_replace('|||', ' | ', $item['content']) . '</td>';
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
            var url = '<?php echo base_url('admin/advice/delete'); ?>';

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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open_multipart('', array('class' => 'form-horizontal'));
            ?>
            <div id="collapseOne" class="collapse in">
                <div class="checkout-step-body">
                    <div class="row">
                        <div class="form-group">
                            <?php
                            echo form_label('Tiêu đề', 'title');
                            echo form_error('title');
                            echo form_input('title', set_value('title'), 'class="form-control text"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Url', 'url');
                            echo form_error('url');
                            echo form_input('url', set_value('url'), 'class="form-control url"');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group col-sm-12 text-right">
                <?php
                echo form_submit('submit', 'OK', 'class="btn btn-primary"');
                echo form_close();
                ?>
                <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Go back</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open_multipart('', array('class' => 'form-horizontal'));
            ?>
            <div id="collapseOne" class="collapse in">
                <div class="checkout-step-body">
                    <div class="row">
                        <div class="form-group picture">
                            <?php
                            echo form_label('Background', 'background');
                            echo form_error('background');
                            echo form_upload('background', set_value('background', $background['image']), 'classs="form-control"');
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
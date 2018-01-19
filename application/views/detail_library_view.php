<!-- InstanceBeginEditable name="content" -->

<section class="main-content container">
    <div class="cover">
        <img src="img/cover-100.jpg">
    </div>
    <div class="news-post">
        <div class="row">
            <div class="left col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="content-title">
                    <h2>Thư viện</h2>
                </div>

                <h1><?php echo $library['library_title']; ?></h1>
                <?php echo $library['library_content']; ?>
            </div>
            <div class="right col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="content-title">
                    <h2>Đăng ký nhận sách</h2>
                </div>
                <div class="contact-form">
                    <label for="inputName">Họ tên (*)</label>
                    <input type="type" class="form-control" id="inputName" placeholder="Họ tên">
                    <br>
                    <label for="inputEmail">Email (*)</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    <br>
                    <label for="inputPhone">Số điện thoại (*)</label>
                    <input type="type" class="form-control" id="inputPhone" placeholder="Số điện thoại">
                    <br>
                    <button type="submit" class="btn btn-default btn-fill">Nhận sách</button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- InstanceEndEditable -->
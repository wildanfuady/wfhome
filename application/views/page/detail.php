<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" style="background: palevioletred">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?= $page['page_title'] ?></h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url() ?>">Home</a>
                        <span><?= $page['page_title'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="page spad">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?= $page['page_content'] ?>
            </div>
        </div>
    </div>
</section>
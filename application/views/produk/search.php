<section class="breadcrumb-section set-bg" style="background: palevioletred">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Hasil Pencarian</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url() ?>">Home</a>
                        <span>Search</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php if($total_product_laris > 0) { ?>
    <section class="categories mt-5">
        <div class="container">
            <div class="section-title">
                <h2>Produk Laris</h2>
            </div>
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php foreach($product_laris as $item) { ?>
                    <div class="col-6 col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?= base_url('assets') ?>/img/product/<?= $item['product_image'] ?>">
                            <h5><a href="<?= base_url('produk/'.$item['product_slug']) ?>"><?= $item['product_name'] ?></a></h5>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($total_product_baru > 0) { ?>
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk Terbaru</h2>
                    </div>
                    <div class="featured__controls">
                        Produk Terbaru dari <?= $toko['toko_name'] ?>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php foreach($product_baru as $item) { ?>
                <div class="col-6 col-lg-3 col-md-4 col-sm-6 mix">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<?= base_url('assets') ?>/img/product/<?= $item['product_image'] ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="<?= base_url('produk/'.$item['product_slug']) ?>"><i class="fa fa-eye"></i></a></li>
                                <li><a href="<?= base_url('produk/beli/'.$item['product_slug']) ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="<?= base_url('produk/'.$item['product_slug']) ?>"><?= $item['product_name'] ?></a></h6>
                            <?php
                            if($item['product_discount'] != 0){
                                $diskon = $item['product_price'] * $item['product_discount'] / 100;
                                $harga = intval($item['product_price'] - $diskon);
                                $tampil_diskon = true;
                            } else {
                                $harga = $item['product_price'];
                                $tampil_diskon = false;
                            }
                            if($tampil_diskon == true) {?>
                            <h5><del <?php echo $item['product_discount'] != 0 ? "style='color:red'" : "" ?>><?= "Rp. ".number_format($item['product_price'], 0, 0, ".") ?></del>&nbsp;&nbsp;<?= "Rp. ".number_format($harga, 0, 0, ".") ?></h5>
                            <?php } else { ?>
                            <h5><?= "Rp. ".number_format($harga, 0, 0, ".") ?></h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </section>
    <?php } else { ?>
    <div class="container mt-5 mb-5">
        <div class="col-md-8 offset-md-2">
        <div class="alert alert-danger">
            Belum ada produk yang tersedia di dalam hasil pencarian ini.
        </div>
        </div>
    </div>
    <?php } ?>

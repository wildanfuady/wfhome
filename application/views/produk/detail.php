<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" style="background: palevioletred">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?= $product['product_name'] ?></h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url() ?>">Home</a>
                        <a href="<?= base_url('kategori/'.$product['category_slug']) ?>"><?= $product['category_name'] ?></a>
                        <span><?= $product['product_name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="<?= base_url('assets/img/product/'.$product['product_image']) ?>" alt="<?= $product['product_name'] ?>" title="<?= $product['product_name'] ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $product['product_name'] ?></h3>
                    <?php
                    if($product['product_discount'] != 0){
                        $diskon = $product['product_price'] * $product['product_discount'] / 100;
                        $harga = intval($product['product_price'] - $diskon);
                        $tampil_diskon = true;
                    } else {
                        $harga = $product['product_price'];
                        $tampil_diskon = false;
                    }
                    if($tampil_diskon == true) {?>
                    <div class="product__details__price"><del <?php echo $product['product_discount'] != 0 ? "style='color:#dd2222'" : "" ?>><?= "Rp. ".number_format($product['product_price'], 0, 0, ".") ?></del>&nbsp;&nbsp;<?= "Rp. ".number_format($harga, 0, 0, ".") ?></div>
                    <?php } else { ?>
                    <div class="product__details__price">Rp. <?= number_format($product['product_price'], 0, 0, ".") ?></div>
                    <?php } ?>

                    <p><?= $product['product_desc'] ?>...</p>
                    <?php if($product['product_label'] == "Sold"){?>
                    <a href="#" class="primary-btn">STOK HABIS</a>
                    <?php } else { ?>
                    <ul style="padding-top:0px;border: none">
                        <li><b>Dilihat</b> <span><?= $product['product_view'] ?></span></li>
                        <li><b>Stok</b> <span><?= $product['product_stok'] ?></span></li>
                        <li><b>Berat</b> <span><?= $product['product_weight'] ?></span></li>
                        <?php if($product['product_ragam_warna'] != null){ ?>
                        <li><b>Warna</b> <span><?= $product['product_ragam_warna'] ?></span></li>
                        <?php } ?>
                        <?php if($product['product_ragam_ukuran'] != null){ ?>
                        <li><b>Ukuran</b> <span><?= $product['product_ragam_ukuran'] ?></span></li>
                        <?php } ?>
                    </ul>
                    <div class="product__details__quantity mt-3">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('produk/beli/'.$product['product_slug']) ?>" class="primary-btn" title="Beli Produk"><i class="fa fa-cart-plus"></i> <span class="mobile">BELI</span></a>
                    <?php
                    $generateProductForWA = str_replace(" ", '%20', $product['product_name']);
                    $generateTokoForWA = str_replace(" ", '%20', $toko['toko_name']);
                    ?>
                    <a href="https://api.whatsapp.com/send?phone=<?=$toko['toko_wa1']?>&text=Assalamu'alaikum%20*<?=$generateTokoForWA?>*,%0A%0AIzin%20bertanya%20apakah%20produk%20*<?=$generateProductForWA?>%20(<?= $product['product_code']?>)*%20dengan%20warna%20....%20dan%20ukuran%20....%20ready?" class="primary-btn" style="background: #25d366" target="_blank" title="Chat Whatsapp"><i class="fa fa-whatsapp"></i> <span class="mobile">CHAT</span></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h3>Detail Produk</h3>
                                <hr>
                                <?= $product['product_content'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
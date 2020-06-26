    
        <section class="categories">
            <div class="container">
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

    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk Terbaru</h2>
                    </div>
                    <div class="featured__controls">
                        Produk Terbaru dari DezidMom90.com
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
    </section>

    <div class="banner mb-5">
        <div class="container" style="border: 1px solid #dedede; padding: 30px; border-radius:10px">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                    <svg enable-background="new 0 0 507.2 507.2" version="1.1" viewBox="0 0 507.2 507.2" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" height="40px" width="40px">
                        <circle cx="253.6" cy="253.6" r="253.6" fill="#32BA7C"></circle>
                        <path d="m188.8 368 130.4 130.4c108-28.8 188-127.2 188-244.8v-7.2l-102.4-94.4-216 216z" fill="#0AA06E"></path>
                        <g fill="#fff">
                            <path d="M260,310.4c11.2,11.2,11.2,30.4,0,41.6l-23.2,23.2c-11.2,11.2-30.4,11.2-41.6,0L93.6,272.8   c-11.2-11.2-11.2-30.4,0-41.6l23.2-23.2c11.2-11.2,30.4-11.2,41.6,0L260,310.4z"></path>
                            <path d="m348.8 133.6c11.2-11.2 30.4-11.2 41.6 0l23.2 23.2c11.2 11.2 11.2 30.4 0 41.6l-176 175.2c-11.2 11.2-30.4 11.2-41.6 0l-23.2-23.2c-11.2-11.2-11.2-30.4 0-41.6l176-175.2z"></path>
                        </g>
                    </svg>
                    <h4 class="mt-5">Simpel Order</h4>
                    <p>Proses order sangat cepat dan nggak ribet, langsung lewat form whatsapp</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                    <svg width="40px" height="40px" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="m512 256c0 68.379-26.629 132.67-74.98 181.02-48.348 48.352-112.64 74.98-181.02 74.98s-132.67-26.629-181.02-74.98c-48.352-48.348-74.98-112.64-74.98-181.02s26.629-132.67 74.98-181.02c48.348-48.352 112.64-74.98 181.02-74.98s132.67 26.629 181.02 74.98c48.352 48.348 74.98 112.64 74.98 181.02z" fill="#32BA7C"></path>
                        <path d="m293.91 509.23c53.992-7.9688 103.81-32.918 143.11-72.211 43.344-43.344 69.219-99.504 74.113-159.93l-174.09-174.09-186.48 163.26 72.395 72-21.266 78.746z" fill="rgba(0,0,0,.2)"></path>
                        <path d="m201.69 417 40.711-150.75h-91.84l57.129-163.26h129.35l-57.191 99.23h107.59z" fill="#ffffff"></path>
                    </svg>
                    <h4 class="mt-5">Respon Cepat</h4>
                    <p>Kami siap melayani orderan Anda dengan cepat, teliti, amanah dan profesional.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                    <svg enable-background="new 0 0 384 384" version="1.1" viewBox="0 0 384 384" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px">
                                <circle cx="192" cy="192" r="192" fill="#32BA7C"></circle>
                        <path d="m226.6 96.31c-6.52 0-12.72-2.56-17.32-7.16-4.76-4.76-11.04-7.16-17.28-7.16s-12.52 2.4-17.28 7.16c-4.6 4.6-10.8 7.16-17.28 7.16h-0.04c-13.48 0-24.44 10.96-24.44 24.48 0 6.48-2.56 12.68-7.16 17.28-4.76 4.8-7.16 11.04-7.16 17.28 0 6.28 2.4 12.52 7.16 17.28 4.6 4.6 7.16 10.84 7.16 17.32 0 4.68 1.32 9 3.6 12.72 2.24 3.68 5.48 6.76 9.32 8.8l-34.52 70.32 101.11 101.11c80.982-8.586 146.9-67.515 165.94-144.9l-134.53-134.53c-4.44-4.439-10.52-7.159-17.28-7.159z" enable-background="new" opacity=".1"></path>
                        <polygon points="186.87 211.22 231.41 302 245.13 277.85 207.48 201.11" fill="#ffffff"></polygon>
                        <g fill="#ffffff">
                            <polygon points="207.48 201.11 245.13 277.85 272.62 281.78 228.09 191"></polygon>
                            <polygon points="197.13 211.22 152.59 302 138.87 277.85 176.52 201.11"></polygon>
                        </g>
                        <polygon points="176.52 201.11 138.87 277.85 111.38 281.78 155.91 191" fill="#ffffff"></polygon>
                        <path d="m258.19 138.07c-4.586-4.586-7.162-10.805-7.162-17.29v-1e-3c0-13.504-10.948-24.451-24.451-24.451h-1e-3c-6.484 0-12.704-2.576-17.29-7.161l-1e-3 -1e-3c-9.549-9.549-25.03-9.548-34.579 0-4.586 4.586-10.805 7.162-17.29 7.162h-1e-3c-13.504 0-24.451 10.947-24.451 24.451v1e-3c0 6.485-2.576 12.705-7.162 17.29h-1e-3c-9.549 9.549-9.549 25.031 0 34.58l1e-3 1e-3c4.586 4.586 7.162 10.805 7.162 17.29v1e-3c0 13.504 10.947 24.451 24.451 24.451h1e-3c6.484 0 12.704 2.576 17.29 7.162 9.549 9.549 25.03 9.549 34.579 0l1e-3 -1e-3c4.586-4.585 10.805-7.161 17.29-7.161h1e-3c13.504 0 24.451-10.947 24.451-24.451v-1e-3c0-6.485 2.576-12.704 7.162-17.29v-1e-3c9.55-9.548 9.549-25.03 0-34.58z" fill="#ffffff"></path>
                    </svg>
                    <h4 class="mt-5">Produk Berkualitas</h4>
                    <p>Produk yang kami jual adalah produk dengan brand ternama, terpercaya serta terbukti berkualitas.</p>
                </div>
            </div>
        </div>
    </div>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" style="background: palevioletred">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Keranjang Belanja</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url() ?>">Home</a>
                        <span>Keranjang Belanja</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <?php echo form_open('cart/update'); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Catatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($this->cart->contents() as $items){ ?>
                            <?= form_hidden('rowid[]', $items['rowid']) ?>
                            <tr>
                                <td class="shoping__cart__item" style="width:400px">
                                    <img src="<?= base_url('assets/img/product/'.$items['image']) ?>" alt="<?= $items['name'] ?>" class="" width="100">
                                    <h5><?= $items['name'] ?></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <?= "Rp. ".number_format($items['price'], 0, 0, ".") ?>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                        <?php echo form_input('qty[]', $items['qty']); ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                <?= "Rp. ".number_format($items['subtotal'], 0, 0, ".") ?>
                                </td>
                                <td>
                                    <?= form_textarea('catatan[]', $items['catatan'], ['placeholder' => 'Isi catatan misalnya dengan ukuran produk atau warna produk...', 'style' => 'height: 70px; width: 250px; font-size: 14px; padding: 10px']) ?>
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="<?= base_url('cart/delete/'.$items['rowid']) ?>"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if($this->cart->total_items() != 0) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="<?= base_url() ?>" class="primary-btn">LANJUT BELANJA</a>
                    <button type="submit" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span> Update Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Apply Kupon -->
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <!-- <li>Subtotal <span></span></li> -->
                        <li>Total <span><?= "Rp. ".number_format($this->cart->total()) ?></span></li>
                    </ul>
                    <a href="#" class="primary-btn" data-toggle="modal" data-target="#checkout">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    Keranjang belanja Anda masih kosong. <a href="<?= base_url() ?>" class="primary-btn">BELANJA YUK</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?= form_close() ?>
    </div>
</section>
<!-- Shoping Cart Section End -->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('cart/checkout', ['id' => 'form']) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Anda *</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Anda">
                                <span class="nama-error" style="color:red;font-size:10px"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Whatsapp *</label>
                                <input type="text" name="wa" id="wa" class="form-control" placeholder="No Whatsapp Anda">
                                <span class="wa-error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email Anda">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Lengkap *</label>
                                <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Beritahu kami alamat lengkap Anda seperti no rumah, RT/RW, nama jalan, kelurahan / desa, kecamatan, propinsi dan kode pos"></textarea>
                                <span class="alamat-error text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-simpan" class="btn btn-success btn-block"><i class="fa fa-send"></i> Checkout Pemesanan</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/produk') ?>">Produk</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/produk/tambah') ?>">Tambah</a></li>
              <li class="breadcrumb-item active">Here</li>
            </ol>
          </div>
        </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                Tambah Produk
                <a href="<?= base_url('admin90/produk') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <?= form_open_multipart('admin90/produk/store') ?>
            <div class="card-body">
              <?php
              $inputs = $this->session->flashdata('inputs');
              $errors = $this->session->flashdata('errors');
              if(!empty($errors)) { ?>
              <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger">
                          <b>Warning!</b> Something it's wrong:
                          <ul>
                          <?php foreach($errors as $key => $error) { ?>
                              <li><?= $error ?></li>
                          <?php } ?>
                          </ul>
                      </div>
                  </div>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kode Produk</label>
                    <?= form_input('product_code', $inputs['product_code'], ['class' => 'form-control', 'placeholder' => 'Kode Produk', 'required' => 'required']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Nama Produk</label>
                    <?= form_input('product_name', $inputs['product_name'], ['class' => 'form-control', 'placeholder' => 'Kode Produk', 'required' => 'required']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Harga Produk</label>
                    <?= form_input('product_price', $inputs['product_price'], ['class' => 'form-control', 'placeholder' => 'Harga Produk', 'required' => 'required', 'type' => 'number']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Stok Produk</label>
                    <?= form_input('product_stok', $inputs['product_stok'], ['class' => 'form-control', 'placeholder' => 'Stok Produk', 'required' => 'required', 'type' => 'number']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Berat Produk</label><br/><span class="text-sm">Silahkan isi kolom ini dengan ukuran kg dan tidak perlu menambahkan "kg". Misalnya 2, 0.3, 0.4.</span>
                    <?= form_input('product_weight', $inputs['product_weight'], ['class' => 'form-control', 'placeholder' => 'Berat Produk', 'required' => 'required', 'type' => 'number']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Diskon Produk</label><br/><span class="text-sm">Silahkan isi kolom ini dengan ukuran % dan tidak perlu menambahkan "%" Fungsinya untuk memberikan harga coret. Misalnya cukup dengan 5, 10, 20.</span>
                    <?= form_input('product_discount', $inputs['product_discount'], ['class' => 'form-control', 'placeholder' => 'Diskon Produk', 'required' => 'required', 'type' => 'number']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Keyword Produk</label><br/><span class="text-sm">Keyword ini digunakan agar produk dapat ditelusuri di mesin pencarian Google. Maksimal 140 karakter.</span>
                    <?= form_input('product_keyword', $inputs['product_keyword'], ['class' => 'form-control', 'placeholder' => 'Keyword Produk']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Deskripsi Produk</label><br/><span class="text-sm">Deskripsi ini digunakan agar produk dapat ditelusuri di mesin pencarian Google. Maksimal 140 karakter.</span>
                    <?= form_input('product_desc', $inputs['product_desc'], ['class' => 'form-control', 'placeholder' => 'Deskripsi Produk']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Gambar Produk</label><br/><span class="text-sm">Gambar yang diupload hanya bisa bertipe jpg, jpeg atau png dengan ukuran kurang dari 3 mb, ukuran lebar 1000px dan tinggi 800px.</span>
                    <div class="input-group">
                      <div class="custom-file">
                        <?= form_upload('product_image', '', ['class' => 'custom-file-input', 'id' => 'exampleInputFile']) ?>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Label Produk</label>
                    <?= form_dropdown('product_label', ['' => 'Pilih Label', 'Terbaru' => 'Terbaru', 'Laris' => 'Laris', 'Sold' => 'Sold'], $inputs['product_label'], ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Kategori Produk</label>
                    <?= form_dropdown('category_id', $categories, $inputs['category_id'], ['class' => 'form-control']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Ragam Warna Produk</label><br/><span class="text-sm">Silahkan isi kolom ini dengan ragam warna produk dan pisahkan dengan koma. Misalnya Hijau, Tosca, Pink dll. Kosongkan jika tidak digunakan.</span>
                    <?= form_input('product_ragam_warna', $inputs['product_ragam_warna'], ['class' => 'form-control', 'placeholder' => 'Ragam Warna Produk']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Ragam Ukuran Produk</label><br/><span class="text-sm">Silahkan isi kolom ini dengan ragam ukuran produk dan pisahkan dengan koma. Misalnya XS, M, L, XL dll. Kosongkan jika tidak digunakan.</span>
                    <?= form_input('product_ragam_ukuran', $inputs['product_ragam_ukuran'], ['class' => 'form-control', 'placeholder' => 'Ragam Ukuran Produk']) ?>
                  </div>
                  <div class="form-group">
                    <label for="">Detail Produk</label><br/><span class="text-sm">Detail ini digunakan untuk memberikan penjelasan tentang produk dan akan tampil di halaman website.</span>
                    <?= form_textarea('product_content', $inputs['product_content'], ['class' => 'form-control textarea', 'placeholder' => 'Detail Produk']) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> RESET</button>
                <button type="submit" class="btn btn-success float-right"><i class="fa fa-check-circle"></i> SIMPAN</button>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

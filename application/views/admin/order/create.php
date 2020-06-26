<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/kategori') ?>">Kategori</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/kategori/tambah') ?>">Tambah</a></li>
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
                Tambah Kategori
                <a href="<?= base_url('admin90/kategori') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <?= form_open('admin90/kategori/store') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <?= form_input('category_name', '', ['class' => 'form-control', 'placeholder' => 'Nama Kategori', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                    <label for="">Status Kategori</label>
                    <?= form_dropdown('category_status', ['' => 'Pilih Status', 'Y' => 'Active', 'N' => 'Non Active'], null, ['class' => 'form-control', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                    <label for="">Tampilkan di Thumbnail?</label>
                    <?= form_dropdown('category_thumbnail', ['' => 'Pilih Status', 'Y' => 'Active', 'N' => 'Non Active'], null, ['class' => 'form-control', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                    <label for="">Keyword Kategori</label>
                    <span class="text-sm"><i> * Digunakan untuk memaksimalkan pencarian di Google. Pisahkan dengan koma. Contoh: produk muslimah, baju muslimah. Maksimal 140 karakter.</i></span><br/>
                    <?= form_input('category_keyword', '', ['class' => 'form-control', 'placeholder' => 'Keyword Kategori', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Kategori</label>
                    <span class="text-sm"><i> * Digunakan untuk memaksimalkan pencarian di Google. Pisahkan dengan koma. Contoh: Jual produk baju muslimah merek nibras murah dan berkualitas. Maksimal 140 karakter.</i></span><br/>
                    <?= form_textarea('category_desc', '', ['class' => 'form-control', 'placeholder' => 'Deskripsi Kategori', 'required' => 'required', 'cols' => 1]) ?>
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

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/page') ?>">Page</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/page/tambah') ?>">Tambah</a></li>
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
                Tambah Page
                <a href="<?= base_url('admin90/page') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <?= form_open('admin90/page/store') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Page</label>
                    <?= form_input('page_title', '', ['class' => 'form-control', 'placeholder' => 'Judul Page', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <?= form_textarea('page_content', '', ['class' => 'form-control', 'placeholder' => 'Content', 'required' => 'required', 'cols' => 1, 'id' => 'editor']) ?>
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

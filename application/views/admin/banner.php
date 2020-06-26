<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Setting Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/banner') ?>">Banner</a></li>
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
                Data Banner
            </div>
            <?= form_open_multipart('admin90/banner/update/'.$banner['banner_id']) ?>
            <div class="card-body">
              <?php
                if(!empty($this->session->flashdata('info'))) { ?>
                <div class="alert alert-info">
                    <?= $this->session->flashdata('info') ?>
                </div>
                <?php }
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
                        <img src="<?= base_url('assets/img/banner/'.$banner['banner_image']) ?>" alt="<?= $banner['banner_title'] ?>" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <?= form_input('title', $banner['banner_title'], ['class' => 'form-control', 'placeholder' => 'Judul Banner', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Link</label>
                            <?= form_input('link', $banner['banner_link'], ['class' => 'form-control', 'placeholder' => 'Link', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Banner</label><br/><span class="text-sm">Kosongkan saja jika tidak ingin mengganti gambar. Gambar yang diupload hanya bisa bertipe jpg, jpeg atau png dengan ukuran kurang dari 3 mb, ukuran lebar 850px dan tinggi 450px.</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <?= form_upload('banner_image', '', ['class' => 'custom-file-input', 'id' => 'exampleInputFile']) ?>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> RESET</button>
                <button type="submit" class="btn btn-success float-right"><i class="fa fa-check-circle"></i> UPDATE</button>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

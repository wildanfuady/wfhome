<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/pekerjaan') ?>">Pekerjaan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/tambah-pekerjaan') ?>">Tambah</a></li>
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
              <strong>Tambah Data Pekerjaan Baru</strong>
            </div>
            <?= form_open_multipart('pengawas/store-pekerjaan') ?>
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Tipe Pekerjaan</label>
                      <?= form_dropdown('pekerjaan_tipe', ['' => 'Pilih Tipe Pekerjaan', '1' => 'Komersil (Type 32) Rumah', '2' => 'Subsidi (Type 32) Rumah', '3' => 'Sarana dan Pra Sarana'], $inputs['pekerjaan_tipe'], ['class' => 'form-control', 'placeholder' => 'Tipe Pekerjaan', 'required' => 'required', 'autocomplete' => 'off', 'id' => 'tipe_pekerjaan']) ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="" id="text_jumlah_by_tipe">Jumlah</label>
                      <?= form_input([
                        'name' => 'pekerjaan_unit', 
                        'value' => $inputs['pekerjaan_unit'],
                        'class' => 'form-control', 
                        'placeholder' => '0', 
                        'readonly' => 'readonly', 
                        'reaquired' => 'reaquired', 
                        'id' => 'jumlah_tipe',
                        'type' => 'number'
                        ]);
                      ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nama Kontraktor</label>
                      <?= form_input('pekerjaan_kontraktor', $inputs['pekerjaan_kontraktor'], ['class' => 'form-control', 'placeholder' => 'Kontraktor Pekerjaan', 'required' => 'required', 'autocomplete' => 'off']) ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tanggal Mulai</label>
                      <div class="input-group date" id="datepicker1" data-target-input="nearest">
                        <input type="date" class="form-control" name="pekerjaan_tgl_mulai" placeholder="DD/MM/YYYY" value="<?= $inputs['pekerjaan_tgl_mulai'] ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Jumlah Pekerja</label>
                      <br>
                      <?= form_input('pekerjaan_jumlah_pekerja', $inputs['pekerjaan_jumlah_pekerja'], ['class' => 'form-control', 'placeholder' => 'Jumlah Pekerja Dihitung Otomatis Oleh Sistem', 'readonly' => 'readonly']) ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Deadline</label>
                      <div class="input-group date" id="datepicker2" data-target-input="nearest">
                        <input type="date" class="form-control" name="pekerjaan_deadline" placeholder="DD/MM/YYYY" value="<?= $inputs['pekerjaan_deadline'] ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Progress</label>
                      <?= form_dropdown('pekerjaan_progress', ['' => 'Pilih Progress',0 => '0 %', 30 => '30 %', 60 => '60 %', 100 => '100 %',], $inputs['pekerjaan_progress'], ['class' => 'form-control datepicker', 'placeholder' => 'Progress Pekerjaan', 'required' => 'required', 'autocomplete' => 'off', 'type' => 'number']) ?>
                    </div>
                  </div>
                  
                </div>
                
                <div class="form-group">
                    <label for="">Keterangan Progress</label>
                    <?= form_textarea('pekerjaan_keterangan', $inputs['pekerjaan_keterangan'], ['class' => 'form-control', 'placeholder' => 'Masukan keterangan progress', 'required' => 'required', 'autocomplete' => 'off']) ?>
                </div>
                <div class="form-group">
                    <label for="">Bukti Pekerjaan</label>
                    <br>
                    <small>1. Bagian Depan</small>
                    <br>
                    <?= form_upload('foto1', ['class' => 'form-control']) ?>
                    <br>
                    <small>2. Bagian Kiri</small>
                    <br>
                    <?= form_upload('foto2', ['class' => 'form-control']) ?>
                    <br>
                    <small>3. Bagian Kanan</small>
                    <br>
                    <?= form_upload('foto3', ['class' => 'form-control']) ?>
                    <br>
                    <small>4. Bagian Belakang</small>
                    <br>
                    <?= form_upload('foto4', ['class' => 'form-control']) ?>
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

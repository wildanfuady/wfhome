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
            <?= form_open('pengawas/store-pekerjaan') ?>
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
                      <label for="">Nama Pekerjaan</label>
                      <?= form_input('pekerjaan_nama', $inputs['pekerjaan_nama'], ['class' => 'form-control', 'placeholder' => 'Nama Pekerjaan', 'required' => 'required', 'autocomplete' => 'off']) ?>
                    </div>
                    <div class="form-group">
                      <label for="">Tanggal Mulai</label>
                      <div class="input-group date" id="datepicker1" data-target-input="nearest">
                        <input type="date" class="form-control" name="pekerjaan_tgl_mulai" placeholder="DD/MM/YYYY" value="<?= $inputs['pekerjaan_tgl_mulai'] ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Jumlah Pekerja</label>
                      <?= form_input('pekerjaan_jumlah_pekerja', $inputs['pekerjaan_jumlah_pekerja'], ['class' => 'form-control', 'placeholder' => 'Jumlah Pekerja', 'required' => 'required', 'autocomplete' => 'off', 'id' => 'datepicker1']) ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Kontraktor</label>
                      <?= form_input('pekerjaan_kontraktor', $inputs['pekerjaan_kontraktor'], ['class' => 'form-control', 'placeholder' => 'Kontraktor Pekerjaan', 'required' => 'required', 'autocomplete' => 'off']) ?>
                    </div>
                    <div class="form-group">
                      <label for="">Deadline</label>
                      <div class="input-group date" id="datepicker2" data-target-input="nearest">
                        <input type="date" class="form-control" name="pekerjaan_deadline" placeholder="DD/MM/YYYY" value="<?= $inputs['pekerjaan_deadline'] ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Progress</label>
                      <?= form_input('pekerjaan_progress', $inputs['pekerjaan_progress'], ['class' => 'form-control datepicker', 'placeholder' => 'Progress Pekerjaan', 'required' => 'required', 'autocomplete' => 'off']) ?>
                    </div>
                  </div>
                  
                </div>
                
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <?= form_textarea('pekerjaan_keterangan', $inputs['pekerjaan_keterangan'], ['class' => 'form-control', 'placeholder' => 'Keterangan', 'required' => 'required', 'autocomplete' => 'off']) ?>
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

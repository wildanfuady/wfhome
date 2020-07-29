<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/pekerjaan') ?>">Pekerjaan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/detail-pekerjaan/'.$pekerjaan['pekerjaan_id']) ?>">Detail</a></li>
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
              <strong>Detail Data Pekerjaan</strong>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Tipe Pekerjaan</label>
                      <br>
                      <?= $pekerjaan['pekerjaan_nama'] == 1 ? 'Komersil (Type 32) Rumah' : '' ?>
                      <?= $pekerjaan['pekerjaan_nama'] == 2 ? 'Subsidi (Type 25) Rumah' : '' ?>
                      <?= $pekerjaan['pekerjaan_nama'] == 3 ? 'Sarana dan Pra Sarana' : '' ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="" id="text_jumlah_by_tipe">Jumlah</label>
                        <br>
                        <?php
                        if($pekerjaan['pekerjaan_nama'] == 1 || $pekerjaan['pekerjaan_nama'] == 2){
                            echo $pekerjaan['pekerjaan_unit']." unit";
                        } else {
                            echo $pekerjaan['pekerjaan_unit']." /m<sup>2</sup>";
                        }
                        ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nama Kontraktor</label>
                      <br>
                      <?= $pekerjaan['pekerjaan_kontraktor'] ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Mulai</label>
                            <br>
                            <?= date('d-m-Y', strtotime($pekerjaan['pekerjaan_tgl_mulai'])) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Pekerja</label>
                            <br>
                            <?= $pekerjaan['pekerjaan_jumlah_pekerja'] ?>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <br>
                            <?= $pekerjaan['pekerjaan_keterangan'] ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Deadline</label>
                            <br>
                            <?= date('d-m-Y', strtotime($pekerjaan['pekerjaan_deadline'])) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Progress</label>
                            <br>
                            <?= $pekerjaan['pekerjaan_progress'] ?>%
                        </div>
                        
                    </div>
                  
                </div>
                <div class="form-group">
                    <label for="">Bukti Pekerjaan</label>
                    <br>
                    <div class="row">
                    <?php foreach($uploads as $key => $foto){ ?>
                        <div class="col-md-3">
                            <span><?= $key == 0 ? 'Foto Tampak Depan' : '' ?></span>
                            <span><?= $key == 1 ? 'Foto Tampak Kiri' : '' ?></span>
                            <span><?= $key == 2 ? 'Foto Tampak Kanan' : '' ?></span>
                            <span><?= $key == 3 ? 'Foto Tampak Belakang' : '' ?></span>
                            <a href="<?= base_url('assets/uploads/'.$foto['foto']) ?>" target="_blank"><img src="<?= base_url('assets/uploads/'.$foto['foto']) ?>" class="img-responsive" style="width:100%"></a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <a href="<?= base_url('manajer/pekerjaan') ?>" class="btn btn-info">BACK</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

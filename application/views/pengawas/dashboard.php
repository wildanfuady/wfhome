<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Here</li>
            </ol>
          </div>
        </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Pekerjaan</span>
              <span class="info-box-number">
                <?= $pekerjaan_total ?>
              </span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pekerjaan Selesai</span>
              <span class="info-box-number">
                <?= $pekerjaan_selesai ?>
              </span>
            </div>
          </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pekerjaan On Progress</span>
              <span class="info-box-number">
                <?= $pekerjaan_progress ?>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pekerjaan Reject</span>
              <span class="info-box-number">
                <?= $pekerjaan_reject ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </section>

  <section class="content mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <strong>Data Pekerjaan Terbaru</strong>
              <div class="btn-group float-right">
                <a href="<?= base_url('pengawas/print-pekerjaan-with-pdf') ?>" class="btn btn-sm btn-danger float-right"><i class="fa fa-print"></i> Print Pekerjaan (PDF)</a>
                <a href="<?= base_url('pengawas/print-pekerjaan-with-excel') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-print"></i> Print Pekerjaan (Excel)</a>
              </div>
            </div>
            <div class="card-body">
                <?php if(!empty($this->session->flashdata('success'))) { ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success') ?>
                </div>
                <?php } else if(!empty($this->session->flashdata('info'))) { ?>
                <div class="alert alert-info">
                    <?= $this->session->flashdata('info') ?>
                </div>
                <?php } else if(!empty($this->session->flashdata('warning'))) { ?>
                <div class="alert alert-warning">
                    <?= $this->session->flashdata('warning') ?>
                </div>
                <?php } else if(!empty($this->session->flashdata('error'))) { ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                </div>
                <?php } else {} ?>
                <div class="table-responsive">
                    <table id="table" class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pekerjaan</th>
                            <th>Jumlah</th>
                            <th>Nama Kontraktor</th>
                            <th>Jumlah Pekerja</th>
                            <th>Tanggal Mulai</th>
                            <th>Deadline</th>
                            <th>Progress</th>
                            <th>Keterangan</th>
                            <th>Memo</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pekerjaan as $key => $item) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                              <?php 
                                if($item['pekerjaan_nama'] == 1){
                                  echo "Kormersil (Type 32) Rumah";
                                } else if($item['pekerjaan_nama'] == 2){
                                  echo "Subsidi (Type 25) Rumah";
                                } else {
                                  echo "Sarana dan Prasarana";
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                              if($item['pekerjaan_nama'] == 1 || $item['pekerjaan_nama'] == 2){
                                echo $item['pekerjaan_unit']." unit";
                              } else {
                                echo $item['pekerjaan_unit']." /m<sup>2</sup>";
                              }
                              ?>
                            </td>
                            <td><?= $item['pekerjaan_kontraktor'] ?></td>
                            <td><?= $item['pekerjaan_jumlah_pekerja'] ?></td>
                            <td><?= date('d-m-Y', strtotime($item['pekerjaan_tgl_mulai'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($item['pekerjaan_deadline'])) ?></td>
                            <td><?= $item['pekerjaan_progress'] ?>%</td>
                            <td><?= $item['pekerjaan_keterangan'] ?></td>
                            <td>
                              <?php
                              $date_now = date('Y-m-d');
                              $date_deadline = date('Y-m-d', strtotime($item['pekerjaan_deadline']));

                              $deadline = new DateTime($date_deadline);
                              $tgl_sekarang = new DateTime($date_now);
                              
                              $selisih = $deadline->diff($tgl_sekarang)->days;
                              // echo $selisih;
                              if($deadline < $tgl_sekarang ){
                                if($item['pekerjaan_status'] != "Selesai"){
                                  echo "Pekerjaan Melebihi Batas Deadline";
                                } else {
                                  echo "Pekerjaan telah selesai";
                                }
                              } else if($selisih == 1 || $selisih == 0){
                                  echo "Deadline tinggal 1 hari lagi!";
                              } else if($selisih == 3){
                                  echo "Deadline tinggal 3 hari lagi!";
                              } else if($selisih <= 7){
                                  echo "Deadline tinggal seminggu lagi!";
                              } else {
                                  echo "";
                              }

                              ?>
                            </td>
                            <td>
                              <?php 
                              if($item['pekerjaan_status'] == "Progress"){
                                echo "<div class='btn btn-info btn-sm'>$item[pekerjaan_status]</div>";
                              } else if($item['pekerjaan_status'] == "Selesai"){
                                echo "<div class='btn btn-success btn-sm'>$item[pekerjaan_status]</div>";
                              } else if($item['pekerjaan_status'] == "Pekerjaan Baru"){
                                echo "<div class='btn btn-secondary btn-sm'>$item[pekerjaan_status]</div>";
                              } else {
                                echo "<div class='btn btn-danger btn-sm'>$item[pekerjaan_status]</div>";
                              }
                              ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

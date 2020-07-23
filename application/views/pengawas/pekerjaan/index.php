<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pekerjaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pengawas/pekerjaan') ?>">Pekerjaan</a></li>
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
              Data Pekerjaan
              <div class="btn-group float-right">
                <a href="<?= base_url('pengawas/print-pekerjaan-with-pdf') ?>" class="btn btn-sm btn-danger float-right"><i class="fa fa-print"></i> Print Pekerjaan (PDF)</a>
                <a href="<?= base_url('pengawas/print-pekerjaan-with-excel') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-print"></i> Print Pekerjaan (Excel)</a>
                <a href="<?= base_url('pengawas/tambah-pekerjaan') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Tambah Pekerjaan</a>
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
                            <th>Memo</th>
                            <th>Keterangan</th>
                            <th>Action</th>
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
                            <td><?= $item['pekerjaan_keterangan'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('pengawas/edit-pekerjaan/'.$item['pekerjaan_id']) ?>" class="btn btn-sm btn-primary" title="Edit Progress"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('pengawas/print-pekerjaan-with-pdf/'.$item['pekerjaan_id']) ?>" class="btn btn-sm btn-danger" title="Export To PDF"><i class="fa fa-print"></i></a>
                                    <a href="<?= base_url('pengawas/print-pekerjaan-with-excel/'.$item['pekerjaan_id']) ?>" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-print"></i></a>
                                </div>
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
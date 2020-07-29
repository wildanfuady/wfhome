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
                <a href="<?= base_url('manajer/print-pekerjaan-with-pdf') ?>" class="btn btn-sm btn-danger float-right"><i class="fa fa-print"></i> Print Pekerjaan (PDF)</a>
                <a href="<?= base_url('manajer/print-pekerjaan-with-excel') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-print"></i> Print Pekerjaan (Excel)</a>
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
                            <th>Status</th>
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
                                  $keterangan = " unit";
                                } else if($item['pekerjaan_nama'] == 2){
                                  echo "Subsidi (Type 25) Rumah";
                                  $keterangan = " unit";
                                } else {
                                  echo "Sarana dan Prasarana";
                                  $keterangan = " /m<sup>2</sup>";
                                }
                              ?>
                            </td>
                            <td><?= $item['pekerjaan_unit'].$keterangan ?></td>
                            <td><?= $item['pekerjaan_kontraktor'] ?></td>
                            <td><?= $item['pekerjaan_jumlah_pekerja'] ?></td>
                            <td><?= date('d-m-Y', strtotime($item['pekerjaan_tgl_mulai'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($item['pekerjaan_deadline'])) ?></td>
                            <td><?= $item['pekerjaan_progress'] ?>%</td>
                            <td><?= $item['pekerjaan_keterangan'] ?></td>
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
                            <td>
                                <div class="btn-group">
                                  <a href="<?= base_url('manajer/detail-pekerjaan/'.$item['pekerjaan_id']) ?>" class="btn btn-sm btn-info" title="Detail Pekerjaan" ><i class="fa fa-eye"></i></a>
                                  <button type="button" onclick="showModalEdit('<?= base_url('manajer/status-pekerjaan/'.$item['pekerjaan_id']) ?>', '<?= $item['pekerjaan_status'] ?>');" class="btn btn-sm btn-primary" title="Ubah Status Pekerjaan"><i class="fa fa-edit"></i></button>
                                  <a href="<?= base_url('manajer/hapus-pekerjaan/'.$item['pekerjaan_id']) ?>" class="btn btn-sm btn-danger" title="Hapus Pekerjaan" onclick="return confirm('Apakah Anda yakin ingin menghapus data pekerjaan ini?')"><i class="fa fa-trash-alt"></i></a>
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

<div class="modal" id="ubahStatusPekerjaan">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Status Pekerjaan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <?= form_open('#', ['id' => 'formUbahStatusPekerjaan']) ?>                      
      <!-- Modal body -->
      <div class="modal-body">
        <label for="">Status Pekerjaan</label>
        <?= form_dropdown('status_pekerjaan', ['' => 'Pilih Status', 'Pekerjaan Baru' => 'Pekerjaan Baru', 'Progress' => 'Approve', 'Selesai' => 'Selesai', 'Reject' => 'Batalkan'], '', ['class' => 'form-control', 'id' => 'status_pekerjaan']) ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Update</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
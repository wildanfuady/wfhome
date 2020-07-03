<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Manajer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/manajer') ?>">Manajer</a></li>
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
              <strong>List Semua Data Manajer</strong>
              <div class="btn-group float-right">
                <a href="<?= base_url('admin/tambah-manajer') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Manajer</a>
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
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($manajer as $key => $item) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['username'] ?></td>
                            <td><?= $item['fullname'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['pass_show'] ?></td>
                            <td>
                              <div class="btn-group">
                                <a href="<?= base_url('admin/edit-manajer/'.$item['id']) ?>" class="btn btn-sm btn-primary" title="Edit manajer"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('admin/hapus-manajer/'.$item['id']) ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data manajer ini?')" class="btn btn-sm btn-danger" title="Hapus manajer"><i class="fa fa-trash-alt"></i></a>
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
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
              Data Page
              <a href="<?= base_url('admin90/page/tambah') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Tambah Page</a>
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
                            <th width="50">No</th>
                            <th>Title</th>
                            <th width="150" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pages as $key => $item) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['page_title'] ?></td>
                            <td class="text-center">
                              <div class="btn-group">
                                <a href="<?= base_url('page/'.$item['page_slug']) ?>" class="btn btn-sm btn-primary" title="Detail Page" target="_blank"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin90/page/edit/'.$item['page_id']) ?>" class="btn btn-sm btn-success" title="Edit Page"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('admin90/page/hapus/'.$item['page_id']) ?>" class="btn btn-sm btn-danger" title="Hapus Page" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-alt"></i></a>
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

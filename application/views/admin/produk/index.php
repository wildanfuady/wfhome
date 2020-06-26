<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/produk') ?>">Produk</a></li>
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
              Data Produk
              <a href="<?= base_url('admin90/produk/tambah') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Tambah Produk</a>
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
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($product as $key => $item) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['product_code'] ?></td>
                            <td><?= $item['category_name'] ?></td>
                            <td><?= $item['product_name'] ?></td>
                            <td><?= $item['product_stok'] ?></td>
                            <td><img src="<?= base_url('assets/img/product/'.$item['product_image']) ?>" width="100"></td>
                            <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin90/produk/detail/'.$item['product_id']) ?>" class="btn btn-sm btn-primary" title="Detail Produk"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin90/produk/edit/'.$item['product_id']) ?>" class="btn btn-sm btn-success" title="Edit Produk"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('admin90/produk/hapus/'.$item['product_id']) ?>" class="btn btn-sm btn-danger" title="Hapus Produk" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-alt"></i></a>
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

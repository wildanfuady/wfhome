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
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/produk/detail/'.$product['product_id']) ?>">Detail</a></li>
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
                Detail Produk
                <a href="<?= base_url('admin90/produk') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4 offset-md-4">
                  <img src="<?= base_url('assets/img/product/'.$product['product_image']) ?>" alt="" class="img-fluid">
                </div>
                <div class="col-md-12 mt-3">
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Stok</th>
                          <th>Berat</th>
                          <th>Diskon</th>
                          <th>Label</th>
                          <th>View</th>
                          <th>Create</th>
                      </tr>
                      <tr>
                        <td><?= $product['product_code'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td>Rp. <?= number_format($product['product_price'], 0, 0, ".") ?></td>
                        <td><?= $product['product_stok'] ?></td>
                        <td><?= $product['product_weight'] ?></td>
                        <td><?= $product['product_discount'] == 0 ? "Tidak Ada" : $product['product_discount']."%" ?></td>
                        <td><?= $product['product_label'] ?></td>
                        <td><?= $product['product_view'] ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($product['created_at'])) ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="table-responsive">
                    <table class="table no-border table-sm">
                      <tr>
                        <th width="200">Kategori</th>
                        <td><?= $product['category_name'] ?></td>
                      </tr>
                      <tr>
                        <th width="200">Link</th>
                        <td><a href="<?= base_url('produk/'.$product['product_slug']) ?>" target="_blank"><?= $product['product_name'] ?></a></td>
                      </tr>
                      <tr>
                        <th>Keyword</th>
                        <td><?= $product['product_keyword'] ?></td>
                      </tr>
                      <tr>
                        <th>Deskripsi Pencarian</th>
                        <td><?= $product['product_desc'] ?></td>
                      </tr>
                      <tr>
                        <th>Ragam Warna</th>
                        <td><?= $product['product_ragam_warna'] ?></td>
                      </tr>
                      <tr>
                        <th>Ragam Ukuran</th>
                        <td><?= $product['product_ragam_ukuran'] ?></td>
                      </tr>
                      <tr>
                        <th>Deskripsi Produk</th>
                        <td><?= $product['product_content'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

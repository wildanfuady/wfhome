<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/kategori') ?>">Kategori</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/kategori/detail/'.$category['category_id']) ?>">Detail</a></li>
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
                Detail Kategori
                <a href="<?= base_url('admin90/kategori') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Kategori</th>
                        <td><?= $category['category_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Status Kategori</th>
                        <td><?= $category['category_status'] ?></td>
                    </tr>
                    <tr>
                        <th>Tampilkan di Thumbnail?</th>
                        <td><?= $category['category_thumbnail'] ?></td>
                    </tr>
                    <tr>
                        <th>Keyword Kategori</th>
                        <td><?= $category['category_keyword'] ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi Kategori</th>
                        <td><?= $category['category_desc'] ?></td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

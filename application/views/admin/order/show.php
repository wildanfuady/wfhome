<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modul Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/order') ?>">Order</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/order/detail/'.$order['order_id']) ?>">Detail</a></li>
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
                Detail Order
                <a href="<?= base_url('admin90/order') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
              <h5><i class="fa fa-cart-plus"></i> Rincian Order</h5>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <h6>Detail Order</h6>
                  <table class="table table-sm table-bordered">
                    <tr>
                      <th>Invoice</th>
                      <td class="bg-primary" style="font-weight:700"><?= "#".$order['order_invoice'] ?></td>
                    </tr>
                    <tr>
                      <th>Total Belanja</th>
                      <td><?= "Rp. ".number_format($order['order_total'], 0, 0, ".") ?></td>
                    </tr>
                    <tr>
                      <th>Tanggal</th>
                      <td><?= date('d-m-Y H:i', strtotime($order['order_tgl'])) ?></td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <td>
                        <?php 
                          if($order['order_status'] == "Order Baru"){
                            echo "<div class='btn btn-sm btn-danger'>Order Baru</div>";
                          } else if($order['order_status'] == "Sedang Diproses"){
                            echo "<div class='btn btn-sm btn-warning'>Sedang Diproses</div>";
                          } else if($order['order_status'] == "Sudah Dikirim"){
                            echo "<div class='btn btn-sm btn-info'>Sudah Dikirim</div>";
                          } else {
                            echo "<div class='btn btn-sm btn-success'>Order Selesai</div>";
                          }  
                        ?>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <h6>Detail Pelanggan</h6>
                  <table class="table table-sm table-bordered">
                    <tr>
                      <th>Nama Lengkap</th>
                      <td><?= $order['order_name'] ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?= $order['order_email'] ?></td>
                    </tr>
                    <tr>
                      <th>Whatsapp</th>
                      <td><?= $order['order_wa'] ?></td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td><?= $order['order_address'] ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <h5><i class="fa fa-th"></i> Detail Pemesanan</h5>
              <hr>
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($invoice as $key => $item) { ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= "Rp. ".number_format($item['product_price'], 0, 0, ".") ?></td>
                    <td><?= $item['invoice_qty'] ?></td>
                    <td><?= "Rp. ".number_format($item['invoice_subtotal'], 0, 0, ".") ?></td>
                    <td><?= $item['invoice_catatan'] ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

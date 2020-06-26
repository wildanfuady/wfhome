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
              Data Order
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
                            <th>Invoice</th>
                            <th>Tanggal Order</th>
                            <th>Total Belanja</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $toko = $this->db->get_where('toko', ['toko_id' => 1])->row_array();
                        foreach($order as $key => $item) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= "#".$item['order_invoice'] ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($item['order_tgl'])) ?></td>
                            <td><?= "Rp. ".number_format($item['order_total'], 0, 0, ".") ?></td>
                            <td class="text-center">
                              <?php 
                                if($item['order_status'] == "Order Baru"){
                                  echo "<div class='btn btn-sm btn-danger'>Order Baru</div>";
                                  $link = "#";
                                } else if($item['order_status'] == "Sedang Diproses"){
                                  echo "<div class='btn btn-sm btn-warning'>Sedang Diproses</div>";
                                  $link = "Halo *$item[order_name]*, orderan kamu dengan invoice *$item[order_invoice]* sedang kami proses. Mohon menunggu resi pengiriman dari kami ya.";
                                } else if($item['order_status'] == "Sudah Dikirim"){
                                  echo "<div class='btn btn-sm btn-info'>Sudah Dikirim</div>";
                                  $link = "Halo *$item[order_name]*, orderan kamu dengan invoice *$item[order_invoice]* sudah kami proses. Adapun kami menggunakan $item[order_shipping] sebagai kurir dan ini nomor resinya: $item[order_resi]. Mohon menunggu kehadiran barangnya sampai di rumah ya.";
                                } else {
                                  echo "<div class='btn btn-sm btn-success'>Order Selesai</div>";
                                  $link = "Orderan kamu dengan invoice *$item[order_invoice]* sudah selesai. Terima kasih sudah berbelanja di $toko[toko_name] dan jangan lupa save no kami ya supaya mendapatkan informasi dan promo menarik lainnya.";
                                }  
                              ?>
                            </td>
                            <td class="text-center">
                              <div class="btn-group">
                                
                                <a href="<?= $item['order_status'] != "Order Baru" ? "https://api.whatsapp.com/send?phone=$item[order_wa]&text=".str_replace('', '%20', $link) : '#' ?>" class="btn btn-sm btn-success" title="Kirim Pesan" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                <a href="<?= base_url('admin90/order/detail/'.$item['order_id']) ?>" class="btn btn-sm btn-secondary" title="Detail Order"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin90/order/edit/'.$item['order_id']) ?>" class="btn btn-sm btn-primary" title="Edit Order"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('admin90/order/hapus/'.$item['order_id']) ?>" class="btn btn-sm btn-danger" title="Hapus Order" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-alt"></i></a>
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

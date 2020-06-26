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
              <li class="breadcrumb-item"><a href="<?= base_url('admin90/order/edit/'.$order['order_id']) ?>">Edit</a></li>
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
                Edit Order
                <a href="<?= base_url('admin90/order') ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <?= form_open('admin90/order/update/'.$order['order_id']) ?>
            <div class="card-body">
                <div class="form-group">
                  <label for="">Status Kategori</label>
                  <?= form_dropdown('order_status', ['' => 'Pilih Status', 'Order Baru' => 'Order Baru', 'Sedang Diproses' => 'Sedang Diproses', 'Sudah Dikirim' => 'Sudah Dikirim', 'Order Selesai' => 'Order Selesai'], $order['order_status'], ['class' => 'form-control', 'required' => 'required']) ?>
                </div>
                <div class="form-group">
                  <label for="">Resi Pengiriman</label>
                  <?= form_input('order_resi', $order['order_resi'], ['class' => 'form-control', 'placeholder' => 'Resi Pengiriman']) ?>
                </div>
                <div class="form-group">
                  <label for="">Kurir Pengiriman</label>
                  <?= form_input('order_shipping', $order['order_shipping'], ['class' => 'form-control', 'placeholder' => 'Kurir Pengiriman']) ?>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> RESET</button>
                <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle"></i> UPDATE</button>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

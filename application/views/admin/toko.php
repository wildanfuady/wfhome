<div class="content-wrapper">
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manajemen Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin90/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin90/toko') ?>">Manajement Toko</a></li>
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
                        <?= form_open_multipart('admin90/toko/update/'.$toko['toko_id']) ?>
                        <div class="card-body">
                        <?php
                            if(!empty($this->session->flashdata('info'))) { ?>
                            <div class="alert alert-info">
                                <?= $this->session->flashdata('info') ?>
                            </div>
                            <?php }
                            $errors = $this->session->flashdata('errors');
                            if(!empty($errors)) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <b>Warning!</b> Something it's wrong:
                                        <ul>
                                        <?php foreach($errors as $key => $error) { ?>
                                            <li><?= $error ?></li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Toko *</label>
                                        <?= form_input('toko_name', $toko['toko_name'], ['class' => 'form-control', 'placeholder' => 'Nama Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">WA Admin 1 *</label>
                                        <br/><span class="text-sm">Selalu mulai dengan angka 62 sebagai pengganti 0.</span>
                                        <?= form_input('toko_wa1', $toko['toko_wa1'], ['class' => 'form-control', 'placeholder' => 'WA Admin Utama', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email Toko *</label>
                                        <?= form_input('toko_email', $toko['toko_email'], ['class' => 'form-control', 'placeholder' => 'Email Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Facebook Toko</label>
                                        <?= form_input('toko_fb', $toko['toko_fb'], ['class' => 'form-control', 'placeholder' => 'Facebook Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Instagram Toko</label>
                                        <?= form_input('toko_ig', $toko['toko_ig'], ['class' => 'form-control', 'placeholder' => 'Instagram Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Google Site Verification</label>
                                        <?= form_input('toko_gsv', $toko['toko_gsv'], ['class' => 'form-control', 'placeholder' => 'Google Site Verification Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Google Analytic</label>
                                        <?= form_input('toko_ga', $toko['toko_ga'], ['class' => 'form-control', 'placeholder' => 'Google Analytic Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keyword Toko *</label>
                                        <?= form_input('toko_keyword', $toko['toko_keyword'], ['class' => 'form-control', 'placeholder' => 'Keyword Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Logo *</label><br/><span class="text-sm">Ukuran yang direkomendasikan yaitu lebar 119px dan tinggi 50px. Logo yang diupload hanya bisa bertipe jpg, jpeg atau png dengan ukuran kurang dari 3 mb.</span>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="<?= base_url('assets/img/'.$toko['toko_logo']) ?>" alt="">
                                            </div>
                                            <div class="col-md-8 mt-2">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <?= form_upload('toko_logo', '', ['class' => 'custom-file-input', 'id' => 'exampleInputFile']) ?>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Slogan Toko *</label>
                                        <?= form_input('toko_slogan', $toko['toko_slogan'], ['class' => 'form-control', 'placeholder' => 'Slogan Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">WA Admin 2</label>
                                        <br/><span class="text-sm">Boleh diisi atau tidak.</span>
                                        <?= form_input('toko_wa2', $toko['toko_wa2'], ['class' => 'form-control', 'placeholder' => 'WA Admin']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jadwal Buka Toko *</label>
                                        <?= form_input('toko_jadwal_buka', $toko['toko_jadwal_buka'], ['class' => 'form-control', 'placeholder' => 'Jadwal Buka Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Twitter Toko</label>
                                        <?= form_input('toko_tw', $toko['toko_tw'], ['class' => 'form-control', 'placeholder' => 'Twitter Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Youtube Toko</label>
                                        <?= form_input('toko_yt', $toko['toko_yt'], ['class' => 'form-control', 'placeholder' => 'Youtube Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bing Site Verification</label>
                                        <?= form_input('toko_bing', $toko['toko_bing'], ['class' => 'form-control', 'placeholder' => 'Bing Site Verification Toko']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Dominan Color *</label>
                                        <?= form_input('toko_dominan_color', $toko['toko_dominan_color'], ['class' => 'form-control', 'placeholder' => 'Color Dominan Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi Toko *</label>
                                        <?= form_input('toko_desc', $toko['toko_desc'], ['class' => 'form-control', 'placeholder' => 'Deskripsi Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Favicon *</label><br/><span class="text-sm">Ukuran yang direkomendasikan yaitu lebar 50px dan tinggi 50px. Logo yang diupload hanya bisa bertipe jpg, jpeg atau png dengan ukuran kurang dari 1 mb.</span>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="<?= base_url('assets/img/'.$toko['toko_favicon']) ?>" alt="">
                                            </div>
                                            <div class="col-md-10 mt-2">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <?= form_upload('toko_favicon', '', ['class' => 'custom-file-input', 'id' => 'exampleInputFile']) ?>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nomor Rekening Toko *</label><br/><span class="text-sm">Jika nomor rekening lebih dari 1, pisahkan dengan koma dan spasi. Contoh: Mandiri 9000008404320 (008), BNI Syariah 0632563294 (009), BRI 780401003330530 (002) an Kunthi Syarifah.</span>
                                        <?= form_textarea('toko_bank', str_replace('<br />', '', $toko['toko_bank']), ['class' => 'form-control', 'placeholder' => 'Nomor Rekening Toko', 'required' => 'required']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Toko *</label>
                                        <?= form_textarea('toko_address', $toko['toko_address'], ['class' => 'form-control', 'placeholder' => 'Alamat Toko', 'required' => 'required']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> RESET</button>
                            <button type="submit" class="btn btn-success float-right"><i class="fa fa-check-circle"></i> UPDATE</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $toko = $this->db->get('toko')->row_array();?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <title><?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?></title>
    <meta property="og:locale" content="id" />
    <meta property="og:type" content="website" />
    <!-- Add SEO -->
    <?php if(!empty($seo) && $seo == "home"){ ?>
    <link rel="canonical" href="<?= base_url() ?>" />
    <meta name="description" content="<?= $toko['toko_desc'] ?>">
    <meta name="keywords" content="<?= $toko['toko_keyword'] ?>">
    <meta property="og:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta property="og:description" content="<?= $toko['toko_desc'] ?>"/>
    <meta property="og:keyword" content="<?= $toko['toko_keyword'] ?>" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="<?= $toko['toko_name'] ?>" />
    <meta property="og:image" content="<?= base_url('assets/img/'.$toko['toko_logo']) ?>" />
    <meta property="og:image:secure_url" content="<?= base_url('assets/img/'.$toko['toko_logo']) ?>"/>
    <meta property="og:image:width" content="119" />
    <meta property="og:image:height" content="50" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?= $toko['toko_desc'] ?>" />
    <meta name="twitter:keyword" content="<?= $toko['toko_keyword'] ?>" />
    <meta name="twitter:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta name="twitter:image" content="<?= base_url('assets/img/'.$toko['toko_logo']) ?>" />
    <?php } ?>
    <?php if(!empty($seo) && $seo == "product_detail"){ ?>
    <link rel="canonical" href="<?= base_url('produk/'.$product['product_slug']) ?>" />
    <meta name="description" content="<?= $product['product_desc'] ?>">
    <meta name="keywords" content="<?= $product['product_keyword'] ?>">
    <meta property="og:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta property="og:description" content="<?= $product['product_desc'] ?>"/>
    <meta property="og:keyword" content="<?= $product['product_keyword'] ?>" />
    <meta property="og:url" content="<?= base_url('produk/'.$product['product_slug']) ?>" />
    <meta property="og:site_name" content="<?= $product['product_name'] ?>" />
    <meta property="og:image" content="<?= base_url('assets/img/product/'.$product['product_image']) ?>" />
    <meta property="og:image:secure_url" content="<?= base_url('assets/img/product'.$product['product_image']) ?>"/>
    <meta property="og:image:width" content="119" />
    <meta property="og:image:height" content="50" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?= $product['product_desc'] ?>" />
    <meta name="twitter:keyword" content="<?= $product['product_keyword'] ?>" />
    <meta name="twitter:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta name="twitter:image" content="<?= base_url('assets/img/product/'.$product['product_image']) ?>" />
    <?php } ?>
    <?php if(!empty($seo) && $seo == "kategori_detail"){ ?>
    <link rel="canonical" href="<?= base_url('kategori/'.$category['category_slug']) ?>" />
    <meta name="description" content="<?= $category['category_desc'] ?>">
    <meta name="keywords" content="<?= $category['category_keyword'] ?>">
    <meta property="og:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta property="og:description" content="<?= $category['category_desc'] ?>"/>
    <meta property="og:keyword" content="<?= $category['category_keyword'] ?>" />
    <meta property="og:url" content="<?= base_url('kategori/'.$category['category_slug']) ?>" />
    <meta property="og:site_name" content="<?= $category['category_name'] ?>" />
    <meta property="og:image:width" content="119" />
    <meta property="og:image:height" content="50" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?= $category['category_desc'] ?>" />
    <meta name="twitter:keyword" content="<?= $category['category_keyword'] ?>" />
    <meta name="twitter:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <?php } ?>
    <?php if(!empty($seo) && $seo == "page_detail"){ ?>
    <link rel="canonical" href="<?= base_url('page/'.$page['page_slug']) ?>" />
    <meta name="description" content="<?= $page['page_desc'] ?>">
    <meta name="keywords" content="<?= $page['page_keyword'] ?>">
    <meta property="og:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <meta property="og:description" content="<?= $page['page_desc'] ?>"/>
    <meta property="og:keyword" content="<?= $page['page_keyword'] ?>" />
    <meta property="og:url" content="<?= base_url('page/'.$page['page_slug']) ?>" />
    <meta property="og:site_name" content="<?= $page['page_title'] ?>" />
    <meta property="og:image:width" content="119" />
    <meta property="og:image:height" content="50" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?= $page['page_desc'] ?>" />
    <meta name="twitter:keyword" content="<?= $page['page_keyword'] ?>" />
    <meta name="twitter:title" content="<?php echo isset($judul) ? $judul." - ".$toko['toko_name'] : $toko['toko_name']." - ".$toko['toko_slogan']; ?>" />
    <?php } ?>
<meta name="google-site-verification" content="<?= $toko['toko_gsv'] ?>" />
    <meta name="msvalidate.01" content="<?= $toko['toko_bing'] ?>" />
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/img/'.$toko['toko_favicon']) ?>">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css" type="text/css">
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $toko['toko_ga'] ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', <?= $toko['toko_ga'] ?>);
    </script>
</head>

<body class="hold-transition sidebar-mini <?= isset($sidebar_collapse) == true ? 'sidebar-collapse' : '' ?>">
    <?php $this->load->view('partials/header', ['toko' => $toko]); ?>
    <?php if(isset($page)){ $this->load->view('partials/sidebar_normal', ['toko' => $toko]); } else { $this->load->view('partials/sidebar_home', ['toko' => $toko]); }; ?>
    <?php $this->load->view($content, ['toko' => $toko]); ?>
    <?php $this->load->view('partials/footer', ['toko' => $toko]); ?>
    
    <!-- Js Plugins -->
    <script src="<?= base_url('assets') ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/jquery.slicknav.js"></script>
    <script src="<?= base_url('assets') ?>/js/mixitup.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/main.js"></script>
    <script type="text/javascript">
    $(function(){
        var url = window.location;

        $('.header__menu a').filter(function() {
        return this.href == url;
        }).parent().addClass('active');

        $('ul.nav-treeview a').filter(function() {
        return this.href == url;

        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open') .prev('a').addClass('active'); 
    });
    </script>
    <?php if(isset($plugin_validate) == true){ ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

    $(function() {

        $.validator.addMethod("formRegex", function(value, element) {
            return this.optional(element) || /^[a-z0-9.\-\s]+$/i.test(value);
        }, "Nama lengkap hanya boleh diisi dengan huruf, angka dan spasi");

        $("#form").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 4,
                    formRegex: true,
                },
                email: {
                    email:true,
                    minlength: 11
                },
                wa: {
                    required: true,
                    number:true,
                    minlength: 11
                },
                alamat: {
                    required: true,
                    minlength: 20,
                    formRegex: true
                },
                action: "required"
            },
            messages: {
                nama: {
                    required: "Nama Pelanggan wajib diisi",
                    minlength: "Minimal 4 karakter",
                    formRegex: "Nama lengkap hanya boleh diisi dengan huruf, angka dan spasi"
                },
                email: {
                    email: "Email tidak valid",
                    minlength: "Minimal 11 karakter"
                },
                wa: {
                    required: "No Whatsapp wajib diisi",
                    minlength: "Minimal 11 karakter",
                    number: "No Whatsapp wajib angka"
                },
                alamat: {
                    required: "Alamat wajib diisi",
                    minlength: "Minimal 20 karakter",
                    formRegex: "Nama lengkap hanya boleh diisi dengan huruf, angka, titik dan spasi"
                },
                action: "Silahkan input beberapa data"
            }
        });

    });
    </script>
    <?php } ?>
</body>
</html>
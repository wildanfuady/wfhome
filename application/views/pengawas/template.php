<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo isset($judul) ? $judul." - " : '' ?>Dashboard Admin WFHome</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?php if(isset($plugin_datatable) == true){ ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/datatables/dataTables.bootstrap4.css">
    <?php } ?>
    <?php if(isset($plugin_summernote) == true){ ?>
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/summernote/summernote-bs4.css">
    <?php } ?>
    <?php if(isset($plugin_datepicker) == true){ ?>
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <?php } ?>
    <style>
    .about_developer span{
      font-size: 14px;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini <?= isset($sidebar_collapse) == true ? 'sidebar-collapse' : '' ?>">
    <div class="wrapper">
        <?php $this->load->view('partials/navbar'); ?>
        <?php $this->load->view('pengawas/sidebar'); ?>
        <?php $this->load->view($content); ?>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Tentang Developer</h5>
                <div class="about_developer">
                  <span><i class="fa fa-user"></i> &nbsp;Wildan Fuady</span><br/>
                  <span><i class="fa fa-phone"></i> &nbsp;0877.2268.6655</span><br/>
                  <span><i class="fa fa-envelope"></i> &nbsp;ilmucoding.com@gmail.com</span><br/>
                  <span><i class="fa fa-globe"></i> &nbsp;https://ilmucoding.com</span><br/>
                  <span><i class="fa fa-globe"></i> &nbsp;https://blog.ilmucoding.com</span><br/>
                  <span><i class="fa fa-globe"></i> &nbsp;https://wildanfuady.github.io</span>
                </div>
            </div>
        </aside>
        <?php $this->load->view('partials/footer'); ?>
    </div>

<!-- jQuery -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/template/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php if(isset($plugin_datepicker) == true){ ?>
<!-- InputMask -->
<script src="<?= base_url('assets/template/') ?>plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets/template/') ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/template/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
$(document).ready(function(){
    //Date range picker
    $('#datepicker1').datetimepicker({
      format: 'DD/MM/YYYY'
    });
    $('#datepicker2').datetimepicker({
      format: 'DD/MM/YYYY'
    });
});
</script>
<?php } ?>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/') ?>dist/js/adminlte.min.js"></script>
<?php if(isset($plugin_datatable) == true){ ?>
<!-- DataTable -->
<script src="<?= base_url('assets/template/') ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
$(document).ready(function(){
    $("#table").DataTable();
});
</script>
<?php } ?>
<?php if(isset($plugin_tiny) == true){ ?>
<script src="https://cdn.tiny.cloud/1/wi0bck9xea81zbzmpuzeb2y0sxlivyqko6ezgjravzpv9pzz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: false,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    ],
    link_list: [
        { title: 'My page 1', value: 'http://www.tinymce.com' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
        { title: 'My page 1', value: 'http://www.tinymce.com' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    height: 400,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
        }
    },
    templates: [
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_drawer: 'sliding',
    contextmenu: "link image imagetools table",
  });
</script>
<?php } ?>
<?php if(isset($plugin_upload) == true){ ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/template/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<?php } ?>
<?php if(isset($plugin_summernote) == true){ ?>
<!-- Summernote -->
<script src="<?= base_url('assets/template/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
        height: 300
    })
  })
</script>
<?php } ?>
<script type="text/javascript">
  $(function(){
    var url = window.location;

    $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
    }).addClass('active');

    $('ul.nav-treeview a').filter(function() {
      return this.href == url;

    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open') .prev('a').addClass('active'); 
  
    $("#tipe_pekerjaan").on('change', function(){
        console.log("Tipe Diubah");
        var val_tipe = $("#tipe_pekerjaan").val();
        if(val_tipe == 3){
          $("#text_jumlah_by_tipe").html("Jumlah Pekerjaan /m<sup>2</sup>");
          $("#jumlah_tipe").removeAttr("readonly");
        } else if(val_tipe == 1 || val_tipe == 2){
          $("#text_jumlah_by_tipe").text("Jumlah Unit Rumah");
          $("#jumlah_tipe").removeAttr("readonly");
        } else {
          $("#text_jumlah_by_tipe").text("Jumlah");
        }
    });

    function showModalEdit(href, status) {

      $("#ubahStatusPekerjaan").modal("show");
      
    }
  });
  
</script>
</body>
</html>

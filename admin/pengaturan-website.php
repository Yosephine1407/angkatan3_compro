<?php
session_start();
include 'koneksi.php';

$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);
if (isset($_POST['simpan'])) {
    $website_name = $_POST['website_name'];
    $website_link = $_POST['website_link'];
    $id = $_POST['id'];
    $website_phone = $_POST['website_phone'];
    $website_email = $_POST['website_email'];
    $website_address = $_POST['website_address'];

    if (mysqli_num_rows($queryPengaturan) > 0) {
        if (!empty($_FILES['foto']['name'])) {


            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];

            //kita bikin tipe foto: png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

            //JIKA EXTENSI FOTO TIDAK EXT YANG TERDAFTAR DI ARRAY EXT
            if (!in_array($extFoto, $ext)) {
                echo "Maaf, foto tidak dapat diupload karena format tidak sesuai";
                die;
            } else {
                //pindahkan gambar dari tmp folder ke folder yg sudah kita buat
                // unlink() : mendelete file
                unlink('upload/' . $rowPengaturan['logo']);
                move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/' . $nama_foto);

                $update = mysqli_query($koneksi, "UPDATE  general_setting SET website_name='$website_name', website_link='$website_link', logo='$nama_foto', website_phone='$website_phone', website_email='$website_email', website_address ='$website_address' WHERE id = '$id'");
            }
        } else {
            $update = mysqli_query($koneksi, "UPDATE general_setting SET website_name='$website_name', website_link='$website_link',  website_phone='$website_phone', website_email='$website_email', website_address ='$website_address' WHERE id = '$id'");
        }
    } else {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];


            // png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

            // jika extensi foto tidak ada ext yang terdaftar di array ext
            if (!in_array($extFoto, $ext)) {
                echo "Extension tidak ditemukan";
                die;
            } else {
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
                $insert = mysqli_query($koneksi, "INSERT INTO general_setting(website_name, website_link,logo) VALUES('$website_name', '$website_link','$$nama_foto')");
            }
        } else {
            // print_r($_POST);
            // die;
            $insert = mysqli_query($koneksi, "INSERT INTO general_setting(website_name, website_link) VALUES('$website_name', '$website_link')");
        }
    }


    header("location:pengaturan-website.php");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : "";

$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);


if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }
    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id = '$id'");
    header("location:user.php?ubah=berhasil");
}
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html>

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <?php include 'inc/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/navbar.php'; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12 card">
                                <div class="card-header">Pengaturan Website</div>
                                <div class="table-responsive text-nowrap">
                                    <?php if (isset($_GET['hapus'])):  ?>
                                        <div class="alert alert-primary" role="alert">Data Berhasil Dihapus</div>
                                    <?php endif ?>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo isset($rowPengaturan['id']) ? $rowPengaturan['id'] : '' ?>" required>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="" class="col-form-label">Nama Website</label>
                                                <input type="text" class="form-control" name="website_name" placeholder="Masukkan Nama Website" value="<?php echo isset($rowPengaturan['website_name']) ? $rowPengaturan['website_name'] : '' ?>" required>

                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label for="" class="col-form-label">Website Link</label>
                                            <input type="url" class="form-control" name="website_link" placeholder="Masukkan Link Website" value="<?php echo isset($rowPengaturan['website_link']) ? $rowPengaturan['website_link'] : '' ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="col-form-label">Email</label>
                                            <input type="text" class="form-control" name="website_email" placeholder="Masukkan Email Website" value="<?php echo isset($rowPengaturan['website_email']) ? $rowPengaturan['website_email'] : '' ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="col-form-label">Telepon</label>
                                            <input type="number" class="form-control" name="website_phone" placeholder="Masukkan Telepon Website" value="<?php echo isset($rowPengaturan['website_phone']) ? $rowPengaturan['website_phone'] : '' ?>" required>

                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="website_address" placeholder="Masukkan Alamat Email" value="<?php echo isset($rowPengaturan['website_address']) ? $rowPengaturan['website_address'] : '' ?>" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <div class="col-sm-12">
                                                <label for="" class="col-form-label">Upload Photo</label>
                                                <input type="file" name="foto">
                                                <img width="70" src="upload/<?php echo isset($rowPengaturan['logo']) ? $rowPengaturan['logo'] : '' ?>" alt="">
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                Simpan
                                            </button>
                                            <button class="btn btn-secondary" name="" type="">
                                                <a href="user.php" class="text-white">Kembali</a>
                                            </button>
                                        </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>





                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                        </div>
                        <div>
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                            <a
                                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                target="_blank"
                                class="footer-link me-4">Documentation</a>

                            <a
                                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                target="_blank"
                                class="footer-link me-4">Support</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
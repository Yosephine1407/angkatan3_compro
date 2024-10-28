<?php
session_start();
include 'koneksi.php';




$id = $_GET['pesanId'];
$selectContact = mysqli_query($koneksi, "SELECT * FROM contact WHERE id = $id");
$rowContact = mysqli_fetch_assoc($selectContact);

if(isset($_POST['kirim-sekarang']) && isset($_GET['pesanId'])) {
    $id = $_GET['pesanId'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $balaspesan = $_POST['balaspesan'];

    $headers = "From: yosephine.leoniee@gmail.com" . "\r\n" . "Reply-To: yosephine.leoniee@gmail.com" . "\r\n" . "Content-Type: text/plain; charset=UTF8" . "\r\n" . "MIME-Version: 1.0" . "\r\n";

    if (mail($email, $subject, $balaspesan, $headers)) {
        echo "Berhasil";
        header("Location: contact-admin.php?status=berhasil-terkirim");
        exit();
    } else {
        echo "Gagal";
        header("Location: contact-admin.php?status=gagal-terkirim");
        exit();
    }
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : '' ?> Balas Pesan</div>
                                    <ul style="list-style-type: '-'">
                                        <li>
                                            <pre>Name : <?php echo $rowContact['name'] ?></pre>
                                        </li>
                                        <li>
                                            <pre>Email : <?php echo $rowContact['email'] ?></pre>
                                        </li>
                                        <li>
                                            <pre>Subject : <?php echo $rowContact['subject'] ?></pre>
                                        </li>
                                        <li>
                                            <pre>Message : <?php echo $rowContact['message'] ?></pre>
                                        </li>
                                    </ul>

                                    <?php
                                    // if (isset($_GET['hapus]));
                                    ?>
                                    <!-- <div class="alert alert-success" role="alert">
                                        Data berhasil dihapus
                                        </div> -->
                                    <?php
                                    // endif
                                    ?>

                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <input type="text" name="email" value="<?php echo $rowContact['email'] ?>">
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label" for="">Subject</label>
                                            <input type="text" class="form-control" name="subject" required>
                                        </div>
                                        <div class="mt-3">
                                            <label for="" class="form-label">Balas Pesan</label>
                                            <textarea class="form-control" name="balaspesan" cols="30" rows="10" required></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary" name="kirim-sekarang">Kirim Pesan</button>
                                        </div>
                                    </form>
                                            
                            





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
<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';

$strQuery = "SELECT * FROM admin";
$result = $conn->query($strQuery);
$arrAdmin = $result->fetch_all(MYSQLI_ASSOC);
$result->free_result();
?>
<?php include_once '../common/header.php' ?>
<?php include_once '../common/subheader.php' ?>
<?php include_once '../common/sidebar.php' ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Dashboard</h5>
                            <div class="col-lg-12 d-flex justify-content-end">
                                <a href="index.php" class="btn btn-primary">Admin Detail</a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($arrAdmin)):
                                    foreach ($arrAdmin as $intKey => $arrVal):
                                        ?>
                                        <tr>
                                            <td><?php echo $intKey + 1 ?></td>
                                            <td><?php echo $arrVal['name']; ?></td>
                                            <td><?php echo $arrVal['email']; ?></td>
                                            <td><?php echo $arrVal['is_active']; ?></td>
                                            <td>
                                                

                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            

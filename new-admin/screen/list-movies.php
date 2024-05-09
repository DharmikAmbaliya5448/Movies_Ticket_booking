<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';

$strQuery = "SELECT * FROM theater_show";
$result = $conn->query($strQuery);
$arrscreen = $result->fetch_all(MYSQLI_ASSOC);
$result->free_result();
?>
<?php include_once '../common/header.php' ?>
<?php include_once '../common/subheader.php' ?>
<?php include_once '../common/sidebar.php' ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Screens</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Screens</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Screens</h5>
                            <div class="col-lg-12 d-flex justify-content-end">
                                <a href="#" class="btn btn-primary">Screens Details</a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Show</th>
                                    <th>Screen</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($arrscreen)):
                                    foreach ($arrscreen as $intKey => $arrVal):
                                        ?>
                                        <tr>
                                            <td><?php echo $intKey + 1 ?></td>
                                            <td><?php echo $arrVal['show']; ?></td>
                                            <td><?php echo $arrVal['theater']; ?></td>
                                            
                                            <td>
                                                <div class="d-flex gap-1">
                                                <!-- <a href="edit_movie.php?screen_id=<?php echo $arrVal['id'];?>"
                                                        class="btn btn-primary"><i class="bi bi-pencil"></i>
                                                </a> -->
                                                <a  data-deleteId="<?php echo $arrVal['id'];?>"
                                                   class="btn btn-danger delete-movie"><i class=" ri-delete-bin-5-line"></i>
                                                </a>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <div class="modal fade" id="basicModal" tabindex="-1">
        <form action="delete_movie.php" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Movie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete movie ?
                    </div>
                    <input type="hidden" id="screen_id" name="screen_id" value="" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- End Basic Modal-->
<?php include_once '../common/footer.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).on('click','.delete-movie',function(){
        $('#basicModal').modal('show');
        let screen_id = $(this).attr("data-deleteId");
        if(screen_id) {
            $("#screen_id").val(screen_id);
        }
    });
</script>
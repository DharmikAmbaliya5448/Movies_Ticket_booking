<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';

$strQuery = "SELECT * FROM add_movie";
$result = $conn->query($strQuery);
$arrMovies = $result->fetch_all(MYSQLI_ASSOC);
$result->free_result();
?>
<?php include_once '../common/header.php' ?>
<?php include_once '../common/subheader.php' ?>
<?php include_once '../common/sidebar.php' ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Movies</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Movies</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Movies</h5>
                            <div class="col-lg-12 d-flex justify-content-end">
                                <a href="./add_movies.php" class="btn btn-primary">Add movie</a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Director</th>
                                    <th>Category</th>
                                    <th>Language</th>
                                    <th>Show</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($arrMovies)):
                                    foreach ($arrMovies as $intKey => $arrVal):
                                        ?>
                                        <tr>
                                            <td><?php echo $intKey + 1 ?></td>
                                            <td><?php echo $arrVal['movie_name']; ?></td>
                                            <td><?php echo $arrVal['directer']; ?></td>
                                            <td><?php echo $arrVal['categroy']; ?></td>
                                            <td><?php echo $arrVal['language']; ?></td>
                                            <td><?php echo $arrVal['show']; ?></td>
                                            <td>
                                                <div class="col-md-4">
                                                    <img width="250" src="../assets/movie_images/<?php echo $arrVal['image']; ?>"
                                                            alt="<?php echo $arrVal['movie_name']; ?>"
                                                            class="img-fluid rounded-start"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                <a href="edit_movie.php?movie_id=<?php echo $arrVal['id'];?>"
                                                        class="btn btn-primary"><i class="bi bi-pencil"></i>
                                                </a>
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
                    <input type="hidden" id="movie_id" name="movie_id" value="" />
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
        let movie_id = $(this).attr("data-deleteId");
        if(movie_id) {
            $("#movie_id").val(movie_id);
        }
    });
</script>

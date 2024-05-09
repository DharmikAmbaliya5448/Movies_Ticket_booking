<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
$arrFirstTheatre = [];
$arrSecondTheatre = [];
if (isset($_POST['movie_name']) && $_POST['movie_name'] !== '') {
    $movie_name = $_POST['movie_name'];
    $directer_name = $_POST['directer_name'];
    $category = $_POST['category'];
    $movie_language = $_POST['movie_language'];
    $trailer = $_POST['trailer'];
    $decription = $_POST['description'];
    $action = $_POST['action'];
    $strShows = !empty($_POST['shows']) ? implode(",", $_POST['shows']) : "";
    $release_date = !empty($_POST['release_date']) ? date("d M Y", strtotime($_POST['release_date'])) : "";
    if (!empty($_FILES['poster'])) {
        $strFileName = uniqid() . "." . pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
        $strImage = "../assets/movie_images/" . $strFileName;
        move_uploaded_file($_FILES['poster']['tmp_name'], $strImage);
    }
    $strInsertQuery = "INSERT INTO add_movie(movie_name,directer,release_date,categroy,`language`,you_tube_link,`show`,`action`,decription,image,`status`) 
                    VALUES ('" . $movie_name . "','" . $directer_name . "','" . $release_date . "','" . $category . "','" . $movie_language . "','" . $trailer . "','" . $strShows . "','" . $action . "','" . $decription . "','" . $strFileName . "',1)";
    $result = $conn->query($strInsertQuery);
    if ($conn->insert_id !== '') {

        header("Location:list-movies.php");
    }
} else {
    $strQuery = "SELECT * FROM theater_show";
    $result = $conn->query($strQuery);
    $arrTheatre = $result->fetch_all(MYSQLI_ASSOC);
    $result->free_result();

    $arrFirstTheatre = array_filter($arrTheatre, function ($arr) {
        return $arr['theater'] == 1;
    });
    $arrSecondTheatre = array_filter($arrTheatre, function ($arr) {
        return $arr['theater'] == 2;
    });
}
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
                    <li class="breadcrumb-item"><a href="./list-movies.php">Movies</a></li>
                    <li class="breadcrumb-item active">Add movie</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Add movie</h5>
                            <!-- Multi Columns Form -->
                            <form action="" method="post" class="row g-3 needs-validation" novalidate
                                  enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="movie_name" class="form-label">Movie Name</label>
                                    <input type="text" class="form-control" id="movie_name" name="movie_name" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="directer_name" class="form-label">Director Name</label>
                                    <input class="form-control" name="directer_name" id="directer_name"
                                           placeholder="Directer name" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="release_date" class="form-label">Release Date</label>
                                    <input type="date" class="form-control" id="release_date" name="release_date"
                                           required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <input class="form-control" name="category" id="category" placeholder="Category"
                                           required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="movie_language" class="form-label">Language</label>
                                    <input type="text" class="form-control" id="movie_language" name="movie_language"
                                           required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="trailer" class="form-label">Trailer</label>
                                    <textarea required class="form-control" name="trailer" id="trailer"
                                              placeholder="Enter youtube trailer link"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea required class="form-control" name="description" id="description"
                                              placeholder="Enter description"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="action" class="form-select" required>
                                        <option value="">Choose...</option>
                                        <option value="running">Running</option>
                                        <option value="upcoming">Upcoming</option>
                                    </select>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Theater 1</label>
                                        <div class="col-sm-10">
                                            <?php foreach ($arrFirstTheatre as $strValue): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="shows[]"
                                                           value="<?php echo $strValue['show']; ?>" type="checkbox"
                                                           id="gridCheck<?php echo $strValue['id']; ?>">
                                                    <label class="form-check-label"
                                                           for="gridCheck<?php echo $strValue['id']; ?>">
                                                        <?php echo $strValue['show']; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>


                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Theater 2</label>
                                        <div class="col-sm-10">

                                            <?php foreach ($arrSecondTheatre as $strValue): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="shows[]"
                                                           value="<?php echo $strValue['show']; ?>" type="checkbox"
                                                           id="gridCheck<?php echo $strValue['id']; ?>">
                                                    <label class="form-check-label"
                                                           for="gridCheck<?php echo $strValue['id']; ?>">
                                                        <?php echo $strValue['show']; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="poster" class="form-label">Upload poster</label>
                                    <input type="file" class="form-control" id="poster" name="poster" required/>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="list-movies.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
<?php include_once '../common/footer.php' ?>
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
    $description = $_POST['description'];
    $action = $_POST['action'];
    $strShows = !empty($_POST['shows']) ? implode(",", $_POST['shows']) : "";
    $release_date = !empty($_POST['release_date']) ? date("d M Y", strtotime($_POST['release_date'])) : "";
    if (!empty($_FILES['poster'])) {
        $strFileName = uniqid() . "." . pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
        $strImage = "../assets/movie_images/" . $strFileName;
        move_uploaded_file($_FILES['poster']['tmp_name'], $strImage);
    } else {
        $strFileName = $_POST['hdnImage'];
    }
    $strUpdateQuery = "UPDATE add_movie set movie_name='" . $movie_name . "',directer='" . $directer_name . "',release_date='" . $release_date . "',categroy='" . $category . "',`language`='" . $movie_language . "',you_tube_link='" . $trailer . "',`show`='" . $strShows . "',`action`='" . $action . "',decription='" . $description . "',image='" . $strFileName . "',`status`=1 where id = '".$_GET['movie_id']."' ";
    $result = $conn->query($strUpdateQuery);
    header("Location:./list-movies.php");
    exit;
} else {
    $strEditQuery = "SELECT * FROM add_movie WHERE id = '" . $_GET['movie_id'] . "' ";
    $result = $conn->query($strEditQuery);
    $arrMovie = $result->fetch_assoc();
    $arrShows = !empty($arrMovie['show']) ? explode(",", $arrMovie['show']) : [];

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
    $strDate = '';
    if (!empty($arrMovie['release_date'])) {
        $dateTime = DateTime::createFromFormat('d M Y', $arrMovie['release_date']);
        $strDate = $dateTime->format('Y-m-d');
    }
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
                    <li class="breadcrumb-item"><a href=" ../dashboard / index . php">Home</a></li>
                    <li class="breadcrumb-item"><a href=" ./list-movies . php">Movies</a></li>
                    <li class="breadcrumb-item active">Edit movie</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Edit movie</h5>
                            <!-- Multi Columns Form -->
                            <form action="" method="post" class="row g-3 needs-validation" novalidate
                                  enctype="multipart/form-data">
                                <div class="col - md - 6">
                                    <label for="movie_name" class="form-label">Movie Name</label>
                                    <input type="text" class="form-control" id="movie_name" name="movie_name" required
                                           value=" <?php echo !empty($arrMovie['movie_name']) ? $arrMovie['movie_name'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="directer_name" class="form-label">Director Name</label>
                                    <input class="form-control" name="directer_name" id="directer_name"
                                           placeholder="Directer name" required
                                           value="<?php echo !empty($arrMovie['directer']) ? $arrMovie['directer'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="release_date" class="form-label">Release Date</label>
                                    <input type="date" class="form-control datepicker" id="release_date"
                                           name="release_date"
                                           value="<?php echo $strDate; ?>"
                                           required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <input class="form-control" name="category" id="category" placeholder="Category"
                                           required
                                           value="<?php echo !empty($arrMovie['categroy']) ? $arrMovie['categroy'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="movie_language" class="form-label">Language</label>
                                    <input type="text" class="form-control" id="movie_language" name="movie_language"
                                           required
                                           value="<?php echo !empty($arrMovie['language']) ? $arrMovie['language'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="trailer" class="form-label">Trailer</label>
                                    <textarea required class="form-control" name="trailer" id="trailer"
                                              placeholder="Enter youtube trailer link"><?php echo !empty($arrMovie['you_tube_link']) ? $arrMovie['you_tube_link'] : ""; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea required class="form-control" name="description" id="description"
                                              placeholder="Enter description"><?php echo !empty($arrMovie['decription']) ? $arrMovie['decription'] : ""; ?></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="action" class="form-select" required>
                                        <option value="">Choose...</option>
                                        <option value="running" <?php echo ($arrMovie['action'] === 'running') ? 'selected' : ''; ?>>
                                            Running
                                        </option>
                                        <option value="upcoming" <?php echo ($arrMovie['action'] === 'upcoming') ? 'selected' : ''; ?>>
                                            Upcoming
                                        </option>
                                    </select>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Theater 1</label>
                                        <div class="col-sm-10">
                                            <?php foreach ($arrFirstTheatre as $strValue): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           name="shows[]" <?php echo (in_array($strValue['show'], $arrShows)) ? 'checked' : ''; ?>
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
                                                    <input class="form-check-input"
                                                           name="shows[]" <?php echo (in_array($strValue['show'], $arrShows)) ? 'checked' : ''; ?>
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
                                    <input type="file" class="form-control" id="poster" name="poster" />
                                </div>
                                <div class="col-md-6">
                                    <label for="poster" class="form-label">Poster</label>
                                    <div class="col-md-3">
                                        <img alt="" height="100"
                                             src="../assets/movie_images/<?php echo $arrMovie['image']; ?>"/>
                                        <input type="hidden" name="hdnImage" value="<?php echo $arrMovie['image'];?>" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="list-movies.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
<?php include_once '../common/footer.php' ?>
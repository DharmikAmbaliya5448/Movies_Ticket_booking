<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';

if (isset($_POST['username']) && $_POST['username'] !== '') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $password = $_POST['password'];
  
    if (!empty($_FILES['poster'])) {
        $strFileName = uniqid() . "." . pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
        $strImage = "../assets/movie_images/" . $strFileName;
        move_uploaded_file($_FILES['poster']['tmp_name'], $strImage);
    }
    $strInsertQuery = "INSERT INTO user(username,email,mobile,image) 
                    VALUES ('" . $username . "','" . $email . "','" . $mobile . "','" . $city . "','" . $password . "')";
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
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./list-movies.php">Users</a></li>
                    <li class="breadcrumb-item active">Add Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Add Users</h5>
                            <!-- Multi Columns Form -->
                            <form action="" method="post" class="row g-3 needs-validation" novalidate
                                  enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Add User</label>
                                    <input type="text" class="form-control" id="username" name="username" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" name="email" id="email"
                                           placeholder="email name" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile No</label>
                                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="mobile no"
                                           required/>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           required/>
                                    <!-- <textarea required class="form-control" name="password" id="password"
                                              placeholder="Enter password "></textarea> -->
                                
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
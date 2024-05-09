<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if (isset($_POST['username']) && $_POST['username'] !== '') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $password = $_POST['password'];
   
    if (!empty($_FILES['poster']['name'])) {
        $strFileName = uniqid() . "." . pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
        $strImage = "../assets/movie_images/" . $strFileName;
        move_uploaded_file($_FILES['poster']['tmp_name'], $strImage);
    } else {
        $strFileName = $_POST['hdnImage'];
    }
    $strUpdateQuery = "UPDATE user set username='" . $username . "',email='" . $email . "',mobile='" . $mobile . "',city='" . $city . "',`password`='" . $password . "',image='" . $strFileName . "', id = '".$_GET['user_id']."' ";
    $result = $conn->query($strUpdateQuery);
    header("Location:./list-movies.php");
    exit;
} else {
    $strEditQuery = "SELECT * FROM user WHERE id = '" . $_GET['user_id'] . "' ";
    $result = $conn->query($strEditQuery);
    $arrUsers = $result->fetch_assoc();
   
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
                    <li class="breadcrumb-item"><a href=" ../dashboard / index . php">Home</a></li>
                    <li class="breadcrumb-item"><a href=" ./list-movies . php">Users</a></li>
                    <li class="breadcrumb-item active">Edit Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Edit Users</h5>
                            <!-- Multi Columns Form -->
                            <form action="" method="post" class="row g-3 needs-validation" novalidate
                                  enctype="multipart/form-data">
                                <div class="col - md - 6">
                                    <label for="username" class="form-label">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                           value="<?php echo !empty($arrUsers['username']) ? $arrUsers['username'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" name="email" id="email"
                                           placeholder="email name" required
                                           value="<?php echo !empty($arrUsers['email']) ? $arrUsers['email'] : ""; ?>"/>
                                </div>

                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input class="form-control" name="mobile" id="mobile"
                                           placeholder="mobile" required
                                           value="<?php echo !empty($arrUsers['mobile']) ? $arrUsers['mobile'] : ""; ?>"/>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input class="form-control" name="city" id="city" placeholder="city"
                                           required
                                           value="<?php echo !empty($arrUsers['city']) ? $arrUsers['city'] : ""; ?>"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                           required
                                           value="<?php echo !empty($arrUsers['password']) ? $arrUsers['password'] : ""; ?>"/>
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="poster" class="form-label">Upload poster</label>
                                    <input type="file" class="form-control" id="poster" name="poster" />
                                </div>
                                <div class="col-md-6">
                                    <label for="poster" class="form-label">Poster</label>
                                    <div class="col-md-3">
                                        <img alt="" height="100"
                                             src="../assets/movie_images/<?php echo $arrUsers['image']; ?>"/>
                                        <input type="hidden" name="hdnImage" value="<?php echo $arrUsers['image'];?>" />
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
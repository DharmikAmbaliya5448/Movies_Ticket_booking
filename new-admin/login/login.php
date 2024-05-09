<?php
error_reporting(0);
session_start();
include_once '../common/dbConnection.php';
if(!empty($_SESSION['admin'])) {
    header("Loation:../movies/list-movies.php");
}
if (isset($_POST['username']) && $_POST['username'] !== '') {
    $strQuery = "SELECT * FROM  admin where name='" . $_POST['username'] . "' and password ='" . md5($_POST['password']) . "'  ";
    $result = mysqli_query($conn, $strQuery);
    $row = $result->fetch_assoc();
    if (empty($row)) {
        $_SESSION["invalid_auth"] = true;
        header("Location:login.php");
        exit;
    } else {
        $_SESSION['admin'] = $_POST['username'];
        header("Location:../movies/list-movies.php");
        exit;
    }
}
?>
<?php include_once '../common/header.php' ?>
    <main>
        <div class="container">

            <section
                    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form method="post" class="row g-3 needs-validation" novalidate>
                                        <?php if ($_SESSION['invalid_auth'] === true):
                                            unset($_SESSION["invalid_auth"]);
                                            ?>
                                            <div class="col-12">
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    Please enter valid username and password
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control"
                                                       id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
<?php include_once '../common/footer.php' ?>
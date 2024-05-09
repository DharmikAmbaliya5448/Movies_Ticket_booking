<!DOCTYPE html>
<html>
<head>
  <title>Username and password validation in PHP using AJAX</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="ajaxValidation.js"></script>
  <style type="text/css">
    li{color: red;}
   button{
    margin:10px;
    position: relative;
   }
  </style>
</head>
<body>
  <div class="container col-md-5">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="email" class="form-control" id="userEmail">
    </div>
    <div class="mb-3">
      <label class="col-sm-2 col-form-label">Password</label>
      <input type="password" class="form-control" id="userPassword">
    </div>
    <p id="message"></p>
    <div class="mb-3 col-md-4">
      <button class="form-control btn btn-danger" id="checkValidation">Login</button>
      <a href="../index.php"><button class="form-control btn btn-danger">Back To Home</button></a>
    </div>
  </div>
</body>
</html>
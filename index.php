<?php 
    if(file_exists(__DIR__ . "/autoload.php")){
    require_once __DIR__ . "/autoload.php";
    }


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title> Class-17 </title>
  <!-- bootstrap css -->
  <link rel="stylesheet"
    href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- custom css -->
  <link rel="stylesheet"
    href="./assets/css/style.css">
</head>

<body>

  <?php 

  // form submit action
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
       // get form data 
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $location = $_POST["location"];
        $gender = $_POST["gender"] ?? "";

        // form validation 
        if (empty($name) || empty($email) || empty($phone) || empty($location) ) {
             $msg = createAlert("All fields are Required");
        }else{
            $msg = "<p class=\"alert alert-success d-flex justify-content-between\"> Data Stable  <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" ></button></p>";
        }



  }







?>


  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5 p-5 border shadow rounded">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center"> Create An Account </h5>
          </div>
          <div class="card-body">
            <div class="msg">
              <?php  echo  $msg ?? ""; ?>
            </div>
            <form action=""
              method="POST">
              <div class="my-2">
                <label for=""> Name </label>
                <input type="text"
                  class="form-control"
                  name="name">
              </div>
              <div class="my-2">
                <label for=""> Email </label>
                <input type="text"
                  class="form-control"
                  name="email">
              </div>
              <div class="my-2">
                <label for=""> Phone </label>
                <input type="text"
                  class="form-control"
                  name="phone">
              </div>
              <div class="my-2">
                <label for=""> Location </label>
                <select name="location"
                  id=""
                  class="form-control form-select">
                  <option value="dhaka">Dhaka</option>
                  <option value="rangpur">Rangpur</option>
                  <option value="dinajpur">Dinajpur</option>
                </select>
              </div>
              <div class="my-2">
                <label for="">Gender</label> <br>
                <label for="">
                  <input type="radio"
                    name="gender"
                    id=""
                    value="male"> Male
                </label>
                <label for="">
                  <input type="radio"
                    name="gender"
                    id=""
                    value="female"> Female
                </label>
              </div>
              <div class="my-2">
                <button class="btn btn-primary btn-sm"
                  type="submit"> Submit </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
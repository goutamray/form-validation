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
        $photo = $_POST["photo"];

        // form validation 
        if (empty($name) || empty($email) || empty($phone) || empty($location) ) {
             $msg = createAlert("All fields are Required");
        }else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = createAlert("Invalid Email Address", "warning");
        } else{
            $msg = createAlert("Data Stable", "success");
            resetForm();
          

          // store data to json db 
          $data = json_decode(file_get_contents("./db/team.json"), true);

          array_push($data, [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "location" => $location,
            "gender" => $gender,
            "photo" => $photo,

          ]);

        file_put_contents("./db/team.json", json_encode($data));
        }





  }







?>


  <div class="container mt-5">
    <div class="row ">
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
                  name="name"
                  value="<?php echo old("name")?>">
              </div>
              <div class="my-2">
                <label for=""> Email </label>
                <input type="text"
                  class="form-control"
                  name="email"
                  value="<?php echo old("email")?>">
              </div>
              <div class="my-2">
                <label for=""> Phone </label>
                <input type="text"
                  class="form-control"
                  name="phone"
                  value="<?php echo old("phone")?>">
              </div>
              <div class="my-2">
                <label for=""> Location </label>
                <select name="location"
                  class="form-control form-select">
                  <option value="">--select--</option>
                  <option <?php echo old("location") == 'dhaka' ? "selected" : ""?>
                    value="dhaka">Dhaka</option>
                  <option <?php echo old("location") == 'rangpur' ? "selected" : ""?>
                    value="rangpur">Rangpur</option>
                  <option <?php echo old("location") == 'dinajpur' ? "selected" : ""?>
                    value="dinajpur">Dinajpur</option>
                </select>
              </div>
              <div class="my-2">
                <label for="">Gender</label> <br>
                <label for="">
                  <input type="radio"
                    <?php echo old("gender") == 'male' ? "checked" : ""?>
                    name="gender"
                    id=""
                    value="male"> Male
                </label>
                <label for="">
                  <input type="radio"
                    <?php echo old("gender") == 'female' ? "checked" : ""?>
                    name="gender"
                    id=""
                    value="female"> Female
                </label>
              </div>
              <div class="my-2">
                <label for=""> Photo </label>
                <input type="text"
                  class="form-control"
                  name="photo"
                  value="<?php echo old("photo")?>">
              </div>
              <div class="my-2">
                <button class="btn btn-primary btn-sm"
                  type="submit"> Submit </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Name</th>
              <th>email</th>
              <th>phone</th>
              <th>location</th>
            </tr>
          </thead>
          <tbody>

            <?php
           $team_data = json_decode(file_get_contents("./db/team.json"));
           foreach($team_data as $team) : 
          ?>
            <tr class="align-middle">
              <td> <img src="<?php echo $team -> photo ?>"
                  alt=""></td>
              <td><?php echo $team -> name ?></td>
              <td> <?php echo $team -> email ?></td>
              <td> <?php echo $team -> phone ?> </td>
              <td> <?php echo $team -> location ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>





  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
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
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- custom css -->
  <link rel="stylesheet"
    href="./assets/css/style.css">

</head>

<body>

  <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // GET FORM DATA 
  $name = $_POST["name"];
  $phone = $_POST["phone"];

  // file manage 
  $tmp_name = $_FILES["profile"]["tmp_name"];
  $file_name = $_FILES["profile"]["name"];
  $file_size = $_FILES["profile"]["size"] / (1024 * 1024);

  // get file extension
  $file_arr = explode(".", $file_name);
  $file_ext = strtolower(end($file_arr));

  // file name unique 
   $unique_file_name = time() . "_" . rand(100000, 10000000) . "." .   $file_ext;

  // check validation 
  if (empty($name) || empty($phone)) {
     $msg = createAlert("All fields are required");
  }else if(!in_array($file_ext, ["png", "jpeg", "jpg", "gif", "webp"])){
    $msg = createAlert("Invalid File Format", "warning");
  }else if($file_size >= 500){
    $msg = createAlert("File Size Limit Over!", "warning");
  } else{
    // upload file 
    move_uploaded_file($tmp_name, "photos/" .  $unique_file_name);

    // upload gallery photos
    for($i = 0; $i < count($_FILES["gallery"]["name"]); $i++){
      // file info 
      $gall_tmp_name = $_FILES["gallery"]["tmp_name"][$i];
      $gall_name = $_FILES["gallery"]["name"][$i];

       // get file extension
      $gall_file_arr = explode(".", $file_name);
      $gall_file_ext = strtolower(end($gall_file_arr));

      // file name unique 
      $gall_unique_file_name = time() . "_" . rand(100000, 10000000) . "." .   $gall_file_ext;

      move_uploaded_file($gall_tmp_name, "gallery/" . $gall_unique_file_name); 
    }

    $msg = createAlert("Account created Successful", "success");
    resetForm(); 
  }

}


?>

  <div class="container mt-5">
    <div class="row ">
      <div class="col-md-5 p-5 border shadow rounded">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center"> Update Your Profile </h5>
          </div>
          <div class="card-body">
            <div class="msg">
              <?php echo $msg ?? "" ?>
            </div>
            <form action=""
              method="POST"
              enctype="multipart/form-data">
              <div class="my-2">
                <label for=""> Name </label>
                <input type="text"
                  name="name"
                  value="<?php echo old("name")?>"
                  class="form-control">
              </div>
              <div class="my-2">
                <label for=""> Phone Number </label>
                <input type="text"
                  name="phone"
                  value="<?php echo old("phone")?>"
                  class="form-control">
              </div>
              <div class="my-2">
                <label for=""> Profile Photo </label>
                <label class="my-class">
                  <input type="file"
                    id="profile-photo"
                    name="profile"
                    class="form-control">
                  <img id="profile-photo-icon"
                    src="https://e7.pngegg.com/pngimages/914/512/png-clipart-icloud-clip-cart-upload-computer-icons-computer-file-icon-drawing-upload-miscellaneous-blue-thumbnail.png"
                    alt="">
                </label>
                <div class="prev-image">
                  <img id="profile-photo-preview"
                    src=""
                    alt="">
                  <button type="button"
                    id="profile-photo-close"> <i class="fa-solid fa-xmark"></i> </button>
                </div>
                <div class="my-2">
                  <label> Gallery Photos </label>
                  <label class="my-class">
                    <input type="file"
                      multiple
                      id="gallery-photo"
                      name="gallery[]"
                      class="form-control">
                    <img id="gallery-photo-icon"
                      src="https://e7.pngegg.com/pngimages/914/512/png-clipart-icloud-clip-cart-upload-computer-icons-computer-file-icon-drawing-upload-miscellaneous-blue-thumbnail.png"
                      alt="">
                  </label>
                </div>
              </div>
              <div class="my-2">
                <button type="submit"
                  class="btn btn-primary w-100"> Submit </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  const profilePhoto = document.getElementById("profile-photo");
  const previewPhoto = document.getElementById("profile-photo-preview");
  const profilePhotoIcon = document.getElementById("profile-photo-icon");
  const previewCloseBtn = document.getElementById("profile-photo-close");

  profilePhoto.onchange = (e) => {
    const fileData = e.target.files[0];
    const fileUrl = URL.createObjectURL(fileData);

    previewPhoto.setAttribute("src", fileUrl);
    profilePhotoIcon.style.display = "none";
    previewCloseBtn.style.display = "block";
  }

  previewCloseBtn.onclick = () => {
    previewPhoto.setAttribute("src", "");
    profilePhotoIcon.style.display = "block";
    previewCloseBtn.style.display = "none";
  }
  </script>



</body>

</html>
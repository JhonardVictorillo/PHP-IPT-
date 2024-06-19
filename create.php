
<?php

include_once("connect.php");


  //  echo'<pre>';
  //  var_dump($_FILES);
  //  echo '<pre>';
  $errors = [];
  $result =[];
  $message = 'Added Successfully';
  $fname = '';
  $lname = '';
  $age = '';
  $gender = '';
  $bdate = '';
  $contact = '';
  $address = '';

   if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $fname = $_POST['pfname'];
  $lname = $_POST['plname'];
  $age = $_POST['age'];
  $gender = $_POST['pgender'];
  $bdate = $_POST['pbdate'];
  $contact = $_POST['pcontact'];
  $address = $_POST['paddress'];

          
          if(!$fname){
            $errors[] = 'Patient firstname required';
          }
          if(!$lname){
            $errors[] = 'Patient lastname required';
          }
          if(!$age){
            $errors[] = 'Patient Age required';
          }
          if(!$gender){
            $errors[] = 'Patient Gender required';
          }
          if(!$bdate){
            $errors[] = 'Patient Birthdate required';
          }
          if(!$contact){
            $errors[] = 'Patient Contact required';
          }
          if(!$address){
            $errors[] = 'Patient Addresss required';
          }


          if(!is_dir('images')){
              mkdir('images');
          }


      if(empty($errors)){  
        
        $image = $_FILES['image'] ?? null;
        $imagepath= '';
      

        if($image){

         
            $imagepath = 'images/'.randomString(8).'/'.$image['name'];

                   mkdir(dirname($imagepath));
            
        move_uploaded_file($image['tmp_name'],$imagepath);
        }


  $statement = $conn->prepare("INSERT INTO tbl_patients (p_firstname,p_lastname,p_age,p_gender,
  p_dateofbirth,p_contact,p_address,p_image) VALUES (:firstname,:lastname,:age,:gender,:birthdate,:contact,:paddress,:pimage)");


    $statement->bindValue(':firstname',$fname);
    $statement->bindValue(':lastname',$lname);
    $statement->bindValue(':age',$age);
    $statement->bindValue(':gender',$gender);
    $statement->bindValue(':birthdate',$bdate);
    $statement->bindValue(':contact',$contact);
    $statement->bindValue(':paddress',$address);
    $statement->bindValue(':pimage',$imagepath);

    $result = $statement-> execute();
    
    $fname = '';
    $lname = '';
    $age = '';
    $gender = '';
    $bdate = '';
    $contact = '';
    $address = '';


   }
  }

  function randomString($n){

    $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < $n; $i++){
        $index = rand(0,strlen($character)-1);
        $str .= $character[$index];

    }
    return $str;

  }



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel = "stylesheet" href = "design.css">

    <title>PATIENT MANAGEMENT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body class="createcss">
    <h1>ADD PATIENT RECORD</h1>

      <?php if(!empty($errors)):?>
    <div class = "alert alert-danger">
    <?php foreach($errors as $sayop ): ?>
          <div><?php echo $sayop ?></div>
          <?php endforeach; ?>
    </div>
      <?php endif; ?>

      <?php if($result): ?>
        <div class="alert alert-success">

        <?php echo 'Record Added Successfully' ?>
        </div>

          <?php endif; ?>



    <form action= "create.php"method="post" enctype ="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name ="pfname" value = "<?php echo $fname ?>"
            class="form-control">
              </div>

              <div class="mb-3">
            <label class="form-label">lastname Name</label>
            <input type="text" name= "plname" value = "<?php echo $lname ?>"
            class="form-control">
            </div>

              <div class="mb-3">
              <label class="form-label">Age</label>
              <input type="text" name = "age"value = "<?php echo $age ?>"
              class="form-control">
              </div>

              <div class="mb-3">
              <label class="form-label">Gender</label>
              <input type="text" name = "pgender"value = "<?php echo $gender ?>" 
              class="form-control">
              </div>

              <div class="mb-3">
              <label class="form-label">Date of birth</label>
              <input type="text" name= "pbdate"value = "<?php echo $bdate ?>"
              class="form-control">
              </div>

            <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name= "pcontact"value = "<?php echo $contact ?>"
            class="form-control">
            </div>

          <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="paddress"value = "<?php echo $address ?>"
          class="form-control">
          </div>

        <div class="mb-3">
       <label class="form-label">Patient image</label>
        <input type="file" name="image" class="form-control">
       </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href = 'CRUD.php'type="submit" class="btn btn-primary">Back</a>
</form>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<?php

include_once("connect.php");

$id = $_GET['id'] ?? null;

if(!$id){
    header('Location: CRUD.php');
    exit;

}
        $statement = $conn->prepare('SELECT * FROM tbl_patients WHERE p_id=:id');
        $statement->bindvalue(':id',$id);
        $statement->execute();
        $patient =$statement->fetch(PDO::FETCH_ASSOC);




  //  echo'<pre>';
  //  var_dump($_FILES);
  //  echo '<pre>';
  $errors = [];
  $result =[];
  
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
        $imagepath= $patient['p_image'];

        if($patient['p_image']){
            unlink($patient['p_image']);

        }
      

        if($image){

         
            $imagepath = 'images/'.randomString(8).'/'.$image['name'];

                   mkdir(dirname($imagepath));
            
        move_uploaded_file($image['tmp_name'],$imagepath);
        }


  $statement = $conn->prepare("UPDATE tbl_patients SET p_firstname=:firstname,p_lastname=:lastname,p_age=:age,p_gender=:gender,
  p_dateofbirth=:birthdate,p_contact=:contact,p_address=:paddress,p_image=:pimage WHERE p_id = :id");


    $statement->bindValue(':firstname',$fname);
    $statement->bindValue(':lastname',$lname);
    $statement->bindValue(':age',$age);
    $statement->bindValue(':gender',$gender);
    $statement->bindValue(':birthdate',$bdate);
    $statement->bindValue(':contact',$contact);
    $statement->bindValue(':paddress',$address);
    $statement->bindValue(':pimage',$imagepath);
    $statement->bindValue(':id',$id);

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

  <body>
    <h1>UPDATE PATIENT RECORD</h1>

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



    <form action= ""method="post" enctype ="multipart/form-data">

            <?php if($patient['p_image']):?>
                <img src="<?php echo $patient['p_image']?>" class="image-update">
                <?php endif;?>

          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name ="pfname" value = "<?php echo $patient['p_firstname']?>"
            class="form-control">
              </div>

              <div class="mb-3">
            <label class="form-label">lastname Name</label>
            <input type="text" name= "plname" value = "<?php echo $patient['p_lastname']?>"
            class="form-control">
            </div>

              <div class="mb-3">
              <label class="form-label">Age</label>
              <input type="text" name = "age"value = "<?php echo $patient['p_age']?>"
              class="form-control">
              </div>

              <div class="mb-3">
              <label class="form-label">Gender</label>
              <input type="text" name = "pgender"value = "<?php echo $patient['p_gender'] ?>" 
              class="form-control">
              </div>

              <div class="mb-3">
              <label class="form-label">Date of birth</label>
              <input type="text" name= "pbdate"value = "<?php echo $patient['p_dateofbirth'] ?>"
              class="form-control">
              </div>

            <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name= "pcontact"value = "<?php echo $patient['p_contact'] ?>"
            class="form-control">
            </div>

          <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="paddress"value = "<?php echo $patient['p_address'] ?>"
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
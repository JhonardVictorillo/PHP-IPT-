
<?php

include_once("connect.php");


    $statement = $conn->prepare("SELECT * FROM tbl_patients");
    $statement->execute();
    $patient = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>Patient CRUD</h1>
    <a href ="create.php" type="button" class="btn btn-sm btn-primary">ADD PATIENT</a>

   

    <table class="table table-success  table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>  
      <th scope="col">PATIENT ID</th>
      <th scope="col">FIRSTNAME</th>
      <th scope="col">LASTNAME</th>
      <th scope="col">AGE</th>
      <th scope="col">GENDER</th>
      <th scope="col">DATEOFBIRTH</th>
      <th scope="col">CONTACT</th>
      <th scope="col">ADDRESS</th>
      <th scope="col">IMAGES</th>
      <th scope="col">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($patient as $i => $patient): ?>
        <tr>
            <th scope = "row"><?php echo $i + 1 ?></th>
            <td><?php echo $patient['p_id'] ?></td>
            <td><?php echo $patient['p_firstname'] ?></td> 
            <td><?php echo $patient['p_lastname'] ?></td>
            <td><?php echo $patient['p_age'] ?></td>
            <td><?php echo $patient['p_gender'] ?></td>
            <td><?php echo $patient['p_dateofbirth'] ?></td>
            <td><?php echo $patient['p_contact'] ?></td>
            <td><?php echo $patient['p_contact'] ?></td>
            <td><image src = <?php echo $patient['p_image'] ?> class = "thumbnail"></td>
            <td>
            <a href ="update.php?id=<?php echo $patient['p_id'] ?>" type="button" class="btn btn-sm btn-outline-success">EDIT</a>
            <!-- <a href="delete.php?id=< ?php echo $patient['p_id']?>" type="button" class="btn btn-sm btn-outline-danger">DELETE</a> -->
            <form  style = "display: inline-block" method = "POST" action="delete.php" >
              <input type ="hidden" name="id" value="<?php echo $patient['p_id']?>">
              <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>


            </form>
          
          
          </td>
            
           
        </tr>

        <<?php endforeach; ?>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
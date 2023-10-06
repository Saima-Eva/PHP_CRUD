<?php

session_start();


if(isset($_SESSION['auth'])){
   if($_SESSION['auth']!=1){
      header("location:login.php");
   }
}
else{
  header("location:login.php");
}


include "lib/connection.php";

//insertSql start
$result = null;
if(isset($_POST['add_student'])){

  $name   = $_POST['student_name'];
  $email  = $_POST['student_email'];
  $gender = $_POST['student_gender'];
  $age    = $_POST['student_age'];
  $s_pass = md5($_POST['s_password']);
  $c_pass = md5($_POST['c_password']);

  if($s_pass == $c_pass){
    
    $insertSql = " INSERT INTO student_info(name, email, gender, age, pass) 
    VALUES
    ('$name', '$email', $gender, $age, '$s_pass')";
   
    if($conn -> query($insertSql)){
      $result = "Data Added Successfully";
    }
    else{
      die($conn -> error);
    }
  }
  else{
    $result = "password not matched";
  }

}
//insertSql end

//selectSql start
$selectSql = "SELECT * FROM student_info";

$result_student = $conn -> query($selectSql);

echo $result_student -> num_rows;
//selectSql end


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- form -->
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

          <label for="student_name">Name</label></br>
          <input type="text" name="student_name" placeholder="Enter Name" id="student_name" Required></br>

          <label for="student_email">Email</label></br>
          <input type="email" name="student_email" placeholder="Enter Email" id="student_email" Required></br>

          <label for="student_gender">Gender</label></br>
          <select name="student_gender" id="student_gender">
            <option value="0" selected>Male</option>
            <option value="1">Female</option>
          </select></br>

          <label for="">Age</label></br>
          <input type="number" name="student_age" placeholder="Enter Age" id="student_age" Required></br>

          <label for="">Password</label></br>
          <input type="password" name="s_password" placeholder="Enter Password" id="s_password" Required></br>

          <label for="">Confirm Password</label></br>
          <input type="password" name="c_password" placeholder="Enter Confirm Password" id="c_password" Required></br></br>

          <input type="submit" name="add_student" value="Submit"></br>

        </form>
          <!-- form -->
          <!--result-->
          <div class></div>
            <?php echo $result; ?>
          </div>
          <!--result-->

          <!-- student data -->
          <div>
            <table border="1" cellpadding="10">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Action</th>
              </tr>
              <?php if($result_student -> num_rows > 0){ ?>
                <?php while($student_row = $result_student -> fetch_assoc()){ ?>
              <tr>
                <td><?php echo $student_row['name']; ?></td>
                <td><?php echo $student_row['email']; ?></td>
                <td>
                  <?php if ($student_row['gender']==0)
                           {echo "Male";} 
                         else
                            {echo "Female";} 
                  ?>
                  </td>
                <td><?php echo $student_row['age']; ?></td>
                <td>
                  <a href="lib/edit.php?id=<?php
                      echo $student_row['id'];
                  ?>">Edit</a>
                  <a href="lib/delete.php?id=<?php
                     echo $student_row['id'];
                   ?>">Delete</a>
                </td>
              <?php } ?>
              <?php } else{ ?>
                <tr>
                  <td colspan="5"> no data to show</td>
                </tr>
                <?php } ?>
            </table>
          </div>
          <!-- student data -->
          </div>
        <a href="logout.php">Logout</a>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
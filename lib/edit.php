<?php
    include "connection.php";

    if(isset($_POST['edit_btn'])){
       $edit_id =$_POST['edit_id'];
       $name    =$_POST['student_name'];
       $email   =$_POST['student_email'];
       $gender  =$_POST['student_gender'];
       $age     =$_POST['student_age'];

       $updateSql = "UPDATE student_info 
       SET name='$name', email='$email', gender=$gender, age=$age 
       where id=$edit_id ";

       if($conn->query($updateSql)){
        header("location:../index.php");
       }
       else{
        die($conn->error);
       }
    }

    if(isset($_GET['id'])){

      $edit_id = $_GET['id'];

      $selectSql = "SELECT id, name, email, gender, age 
      FROM student_info 
      where id = $edit_id";

      $result_info = $conn -> query($selectSql);

      if($result_info -> num_rows>0){
        while($row_students=$result_info->fetch_assoc()){

        

    


    
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Edit</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
          <div class="col-md-6">
          <!-- form -->
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
           
          <input type="hidden" name="edit_id" value="<?php
              echo $edit_id;
          ?>">

          <label for="student_name">Name</label></br>
          <input type="text" name="student_name" placeholder="Enter Name" id="student_name" value="<?php
              echo $row_students['name'];
          ?>" Required></br>

          <label for="student_email">Email</label></br>
          <input type="email" name="student_email" placeholder="Enter Email" id="student_email" value="<?php
              echo $row_students['email'];
          ?>" Required></br>

          <label for="student_gender">Gender</label></br>
          <select name="student_gender" id="student_gender">
            <option value="0" <?php
                if($row_students['gender']==0){
                  echo "selected";
                }
            ?> >Male</option>
            <option value="1" <?php
                if($row_students['gender']==1){
                  echo "selected";
                }
            ?> >Female</option>
          </select></br>

          <label for="">Age</label></br>
          <input type="number" name="student_age" placeholder="Enter Age" id="student_age" value="<?php
              echo $row_students['age'];
          ?>" Required></br></br>

          <input type="submit" name="edit_btn" value="Update"></br>

        </form>
          <!-- from -->
          </div>
      </div>
</div>





  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
}
   }
   else{
    header("location:../index.php");
   }
}
else{
  header("location:../index.php");
}
?>
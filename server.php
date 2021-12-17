<?php include('functions.php');


$conn = mysqliconnect();



//fetching lga data

$state_id = !empty($_POST['id'])? $_POST['id'] : '';



if(!empty($state_id)){
    $query = "SELECT id, name FROM local_governments where state_id = $state_id";

    $res= mysqli_query($conn, $query);

    $count = mysqli_num_rows($res);

    if($count >0){
        echo "<option value=''>-Select local Goverment-</option>";

        while($rows =  mysqli_fetch_assoc($res))
        {
            echo "<option value='". $rows['id']."'>".$rows['name']."</option> <br>";
        }
    }
}




//Post Data

if(isset($_POST['submit'])){
   // echo "Submit";

  

   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   $fullname = "$firstname $middlename $lastname";
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $dob = mysqli_real_escape_string($conn, $_POST['dob']);
   $phone =  mysqli_real_escape_string($conn, $_POST['phone']);
   $address =  mysqli_real_escape_string($conn, $_POST['address']);
   $next_of_kin = mysqli_real_escape_string($conn, $_POST['nextOfKin']);
   $jamb_score = mysqli_real_escape_string($conn, $_POST['jambscore']);

   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  
  
   if(isset($_POST['state'])){
    $state_id = mysqli_real_escape_string($conn, $_POST['state']);

    $query = "SELECT name FROM states where id = $state_id";

    $res= mysqli_query($conn, $query);

    $count = mysqli_num_rows($res);

    if($count >0){

        while($rows = mysqli_fetch_assoc($res)){
            $state = $rows['name'];
        }
    }

   }

   if(isset($_POST['lga'])){
    $lga_id = mysqli_real_escape_string($conn, $_POST['lga']);

    $query = "SELECT name FROM local_governments where id = $lga_id";

    $res= mysqli_query($conn, $query);

    $count = mysqli_num_rows($res);

    if($count >0){

        while($rows = mysqli_fetch_assoc($res)){
            $lga = $rows['name'];
        }
    }

   }

    //image
    if(isset($_FILES['image']['name'])){
 
         $image_name = $_FILES['image']['name'];
 
         if($image_name != ""){

            $image_name = explode(".", $image_name);
            $image_name = end($image_name);

            //rename image
            $image_name = "AVATAR_". rand(0000, 9999). ".". $image_name;

            $src_path = $_FILES['image']['tmp_name'];

            $destination_path = "images/avatar/".$image_name;

            $upload = move_uploaded_file($src_path, $destination_path);

            if($upload == false){

                echo "image not uploaded successful!";
                die();
    
             }
         }
     

        }
        else{

            $image_name="";
         }

         //echo "$firstname, $lastname, $middlename, $email, $dob, $phone, $address, $next_of_kin, $jamb_score, state: $state, lga: $lga, gender: $gender, image: $image_name";


    
    //Insert into database

    $sql = "INSERT INTO students SET
            first_name = '$firstname',
            last_name =  '$lastname',
            middle_name = '$middlename',
            full_name = '$fullname',
            email = '$email',
            DOB = '$dob',
            gender = '$gender',
            phone_no = '$phone',
            address = '$address',
            state = '$state',
            lga = '$lga',
            nextOfKin = '$next_of_kin',
            jambScore = '$jamb_score',
            image_name = '$image_name'
            ";

    $result = mysqli_query($conn, $sql);


    if($result)
    {
        $_SESSION['save'] = "<div class='success'>Details Saved Successfully!</div>";

        header('location:'.URL. 'dashboard.php');
    }

    else{
        
        $_SESSION['save'] = "<div class='failed'>Details Failed to Save!</div>";

        header('location:'.URL. 'portalForm.php');
    }
        
    
   

}

//dashboard

if(isset($_POST['search'])){
    if(isset($_POST['search_name'])){
        $name = $_POST['search_name'];
        
    }

    if(isset($_POST['status'])){
        $status = $_POST['status'];
           
    }

    if(isset($_POST['search_gender'])){
        $search_gender = $_POST['search_gender'];     
        
    }

    if(isset($_POST['search_score'])){
        $search_score = $_POST['search_score'];
        
    }

    $query = "SELECT concat(first_name, ' ' , middle_name, ' ', last_name) as full_name, gender, jambScore, admission_status FROM students
     Where full_name ='$name' AND gender = '$search_gender' AND addmision_status = '$status' ANDjambScore = '$search_score' ";
  
   $result = mysqli_query($conn, $query); 

    $count = mysqli_num_rows($result);

    if($count >0){

        while($rows = mysqli_fetch_assoc($result)){
            $fullname = $rows['full_name'];
            $gender = $rows['gender'];
            $jambscore = $rows['jambScore'];
            $admission_status = $rows['admission_status'];

            ?>

          <tr>
             <td><?= $sn++; ?></td>
             <td><?= $fullname; ?></td>
             <td><?= $gender; ?></td>
             <td><?= $jambscore; ?></td>
             <td><?= $admission_status;?></td>
             <td>eyes</td>
         </tr>

        <?php }
     }




    }else{
        echo "No result";
    }





?>
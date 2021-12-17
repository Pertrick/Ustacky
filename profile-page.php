<?php include('functions.php');

$title = "profile-page";

topNav($title);

$conn = mysqliconnect();

if(isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
?>



<style>
    .header{
        background: #123456;
    }
    .background{
        background:#fff !important;
    }

    footer{
        background: #123456;
    }
</style>

<section class="data">
<div class="wrapper">
    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $query = "SELECT * FROM students WHERE id = $id";

            $result = mysqli_query($conn, $query);

            $count = mysqli_num_rows($result);

            if($result){

                if($count == 1){
                        
                    $rows = mysqli_fetch_assoc($result);
                     $image_name = $rows['image_name'];
                    $fullname = $rows['full_name'];
                    $email= $rows['email'];
                    $gender = $rows['gender'];
                    $phone = $rows['phone_no'];
                    $dob = $rows['DOB'];
                    $address = $rows['address'];
                    $state = $rows['state'];
                    $lga = $rows['lga'];
                    $kin = $rows['nextOfKin'];
                    $jamb_score = $rows['jambScore'];
                    $status = $rows['admission_status'];

                        }
                

            }
        }else{
            $_SESSION['status'] = "<div class='success'>Access Forbiden!</div>";
            header('location:'.URL.'index.php');
        }


    ?>
    <div class="text-center image">
        
        <img src="<?=URL?>images/avatar/<?=$image_name?>" class="img-responsive" height="200px" width="100px " style="margin-bottom:15px;">

        <p><?= $fullname?></p>
        <p class="status"><?= $status ?></p>

    </div>

    <div>
        <p class="green">Personal Information</p>
    
        <p class="info">Email: <?= $email;?></p>
        <p class="info">Gender: <?= $gender;?></p>
        <p class="info">Phone No: <?= $phone;?></p>
        <p class="info">Date Of Birth: <?= $dob;?></p>
        <p class="info">Address: <?= $address;?></p>

    
        
    </div>

   
</div>



    <p class="green">Other Information</p>
    <div class="inline">
    <div>
    <p>State Of Origin: <?= $state;?></p>
    </div>
    <div>
    <p>Local Government: <?= $lga;?></p>
    </div>
    </div>


    
    <p class="green">Academics Related Information</p>
    <div class="inline">
    <div>
    <p>Next of Kin: <?= $kin;?></p>
    </div>
    <div>
    <p>Jamb Score: <?= $jamb_score;?></p>
    </div>

    <div>
    <p>Status: <?= $status;?></p>
    </div>

    <div class="status-form">
    Change Status:

    <form action="" method="POST">
    <select name="score" id="" onchange="this.form.submit();">

        <option value="<?= $status ?>"><?= $status?></option> 
         
        <?php
        if($status == 'undecided')
        { 
            echo '<option value="admitted">admitted</option>';
        
        }else{
            echo '<option value="undecided">undecided</option>'; 

        }
         
         ?>
    </select>

    </form>
    <?php

    if(isset($_POST['score']))
        {
           //echo "$id";
            
            $status =mysqli_real_escape_string($conn, $_POST['score']);

            $query = "UPDATE students SET admission_status= '$status' WHERE id =$id ";

            $result = mysqli_query($conn,$query );


            if($result){
                $_SESSION['status'] = "<div class='success'>Admission Status Changed Successfully!</div>";
            }

            else{
                $_SESSION['status'] = "<div class='success'>failed to change admission status!</div>";
            }
            

        }

        ?>
    </div>
    </div>
    

    

    </section>


<?php

footer();

?>
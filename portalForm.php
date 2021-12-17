<?php require_once('functions.php');

$title ="student Portal Form";

topNav($title);
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

<?php

    
if(isset($_SESSION['save'])){
    echo $_SESSION['save'];
    unset($_SESSION['save']);
}

?>



<div class="form text-left ">
    <h1>Student Portal Form</h1>
    <i>Please fill in all required Information</i>
    <p>Personal Information</p>

<form action="server.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    
<div>
   <label for="image">Upload Image: </label><br>
    <input type="file" name="image" required>
</div>

    <ul>


<li>
    <label for="firstname">First Name</label>
    <input type="text" name="firstname"  placeholder="Enter first name" required pattern="[a-zA-Z]*">
</li>

<li>

    <label for="middlename">Middle Name</label>
    <input type="text" name="middlename"  placeholder="Enter middle name"  required pattern="[a-zA-Z]*">

</li>

<li>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname"  placeholder="Enter last name"  required pattern="[a-zA-Z]*">

</li>

<li>

    <label for="email">Email</label>
    <input type="email" name="email"  placeholder="Enter email"  required>

</li>

<li>

    <label for="DOB">Date of Birth</label>
    <input type="Date" name="dob" required>

</li>



    <label for="male">Male</label>
    <input type="radio" name="gender" value="male" required>

    <label for="female">Female</label>
    <input type="radio" name="gender" value="female" required>



<li>

    <label for="phone">Phone No</label>
    <input type="text" name="phone"   placeholder="Enter phone number" maxlength="11" required>

</li>
<li>

    <label for="phone">Address</label>
    <textarea name="address" id="address" cols="30" rows="1" placeholder="Enter Address"></textarea>


<li>

    <label for="state">State of Origin</label>
    <select name="state" id="state">
    <option value="">-Select State-</option>

        
<?php
    $conn = mysqliconnect();

    $stateData = "SELECT * FROM states";

    $res = mysqli_query($conn, $stateData);

    $count = mysqli_num_rows($res);

    if($count >0){
        while($rows = mysqli_fetch_assoc($res))
        {
            $name = $rows['name'];
            $id = $rows['id'];
            ?>
            
       <?= "<option value=$id>$name</option>";
        }
    }


?>

        
       

    </select>

</li>

<li>

    <label for="lga">Local Government</label>
    <select name="lga" id="lga">
        <option value="">-Select Local Goverment-</option>
        <option value=""></option>

    </select>

</li>


<li>


    <label for="kin"> Next of kin</label>
    <input type="text" name="nextOfKin"   placeholder="Enter your next of kin" required>

</li>

    <p>Academic Related Information</p>

    <li>
    <label for="score">Jamb Score</label>
    <input type="text" name="jambscore"   placeholder="Enter your jamb score" required>
</li>


    <input type="submit" name="submit" value="Submit">



</form>

</div>



<?php
    footer();
?>



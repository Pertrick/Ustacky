<?php  include('functions.php');

$title = "Portal - Dashboard";

topNav($title);

$conn = mysqliconnect();

  
if(isset($_SESSION['save'])){
    echo $_SESSION['save'];
    unset($_SESSION['save']);
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

<p class="green">info! All Students Records Table.</p>

<div class="content">

        <form action="" method="GET">
   
    <input  type="text"  id="names" placeholder="Search Result by Name only" name="search_name"  onkeyup="myFunction()">
    <select name="status" id="status">
        <option value="">-Select Admission Status-</option>
        <option value="admitted">Admitted</option>
        <option value="undecided">Undecided</option>
        
    </select>
    <select name="search_gender" id="gender">
        <option value="">-Select Gender-</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        
    </select>
    <input type="text" id="score" placeholder="Enter Jamb Score" name="search_score">

    <input type="submit" value="search" name="search">

    </form>

    
    <div class="table">
    <table id="tables">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Jamb Score</th>
                <th>Admission Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php
   if(isset($_GET['search'])){
    if(isset($_GET['search_name'])){
        $name = $_GET['search_name'];
        
    }

    if(isset($_GET['status'])){
        $status = $_GET['status'];
           
    }

    if(isset($_GET['search_gender'])){
        $search_gender = $_GET['search_gender'];     
        
    }

    if(isset($_GET['search_score'])){
        $search_score = $_GET['search_score'];
        
    }

   // print_r($_POST);

    $query = "SELECT id, full_name, gender, jambScore, admission_status FROM students
    Where gender = '$search_gender' AND admission_status= '$status' AND jambScore = '$search_score' AND full_name LIKE '%{$name}%' ";
  
   $result = mysqli_query($conn, $query); 

   $count = mysqli_num_rows($result);

   if($count > 0){

       $sn = 1;
      // $arrays  = mysqli_fetch_assoc($result);

      while($rows = mysqli_fetch_assoc($result)){
          $id = $rows['id'];
         $fullname = $rows['full_name'];
          $gender = $rows['gender'];
          $jambscore = $rows['jambScore'];
          $admission_status = $rows['admission_status'];


          ?>
              <td><?= $sn++; ?></td>
              <td><?= $fullname;?></td>
              <td><?= $gender; ?></td>
              <td><?= $jambscore; ?></td>
              <td><?= $status;?></td>
              <td><a href="<?=URL?>profile-page.php?id=<?=$id?>">view</a></td>
          </tr>
<?php

       }
   }

   else{
       ?>
       <tr>
           <td colspan="6">No record found!</td>
       </tr>

       <?php
   }

}
else{

        $query = "SELECT full_name,  id, gender, jambScore, admission_status FROM students";

        $result = mysqli_query($conn, $query);

        $count = mysqli_num_rows($result);

        if($count > 0){

            $sn = 1;
           // $arrays  = mysqli_fetch_assoc($result);

           while($rows = mysqli_fetch_assoc($result)){
               $id = $rows['id'];
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
                <td><a href="<?=URL?>profile-page.php?id=<?=$id?>">view</a></td>
            </tr>

           <?php }
        }

    }


   


?>
           
        </tbody>
    </table>

    </div>
    
</div>

<script type="text/javascript">

        
function myFunction(){
     var filter,  input, table, tr, td, i, txtvalue, input2;

    input= document.getElementById("names");

    filter = input.value.toUpperCase();

    table = document.getElementById("tables");
    tr = document.getElementsByTagName("tr");


    //loop through all table rows

    for(i = 0; i <tr.length; i++){
        td=tr[i].getElementsByTagName("td")[1];

        if(td){
            txtvalue = td.textContent || td.innerText;

            if(txtvalue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }

    

}

</script>


<?php


    footer();
?>

    
    





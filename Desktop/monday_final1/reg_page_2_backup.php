<?php 
class firstPage {

    

private $first_name = "";
private $land_line = " ";
private $last_name = " ";
private $addr_doorno=" ";
private $addr_taluk=" ";
private $middle_name = "";
private $district ;
private $state;
private $ph_number = "";
private $addr_area= " ";
private $sector = "";
private $db ;
//private $taluk;
private $var = 0;

    function connectDatabase(){
      $this->db = mysqli_connect('localhost', 'root', '', 'sericulture') or die("Cannot Connect To Database");
     echo "Connected";
    }

  function getValues(){
      if (isset($_POST['Next']))
    {
  // receive all input values from the form
      if($this->db){
           $this->first_name = mysqli_real_escape_string($this->db, $_POST['first_name']);
           $this->last_name = mysqli_real_escape_string($this->db, $_POST['last_name']);
           $this->middle_name = mysqli_real_escape_string($this->db, $_POST['middle_name']);
           $this->ph_number = mysqli_real_escape_string($this->db, $_POST['pno']);
           $this->land_line = mysqli_real_escape_string($this->db, $_POST['land_line']);
           $this->addr_doorno = mysqli_real_escape_string($this->db, $_POST['addr_doorno']);
           $this->addr_area = mysqli_real_escape_string($this->db, $_POST['addr_area']);
           $this->addr_taluk = mysqli_real_escape_string($this->db, $_POST['addr_taluk']);
         $this->state =mysqli_real_escape_string($this->db, $_POST['state_value']);
           echo $this->state;
        $this->district = mysqli_real_escape_string($this->db, $_POST['district_value']);
           echo $this->district;
           $this->checkValues();
           //$obj->checkAndUpdate();
           $this->updateDB();
          

      }
      else{
          echo "Failed :(";
            }
             }
        }
     /*  function checkAndUpdate(){
  // first check the database to make sure
  // a user does not already exist with the same PhoneNumber
         $user_check_query = "SELECT * FROM producer WHERE mobile='$this->ph_number'";
        $result = mysqli_query($this->db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        echo $this->ph_number;



       if($user){
           if($user['mobile'] === $this->ph_number){
               echo "<script type='text/javascript'>alert('Mobile Number Already Registered');</script>";
            }
        }else{

          $sb='SB';
          date_default_timezone_set("Asia/Calcutta");
          $ack_no = $sb.date('dmyhis', time());
          echo "  en   ";
          echo $ack_no;
                          echo "Updating data base";

        $query = "INSERT INTO producer(fname,lname,mname,mobile,land_line,door_no,area,taluk,state,district,ack_number)
        VALUES('$this->first_name','$this->last_name','$this->middle_name','$this->ph_number',
          '$this->land_line','$this->addr_doorno','$this->addr_area','$this->addr_taluk','$this->state','$this->district','$ack_no')";
        if(mysqli_query($this->db, $query))
              echo "Sucess First Page";
          else echo "Failed while database updation";
      
          if($var === 0){header('location:page_3.html');}
      

      }


}*/

        function check($ph_number){

        $db = mysqli_connect('localhost', 'root', '', 'sericulture') or die("Cannot Connect To Database");
        $user_check_query = "SELECT * FROM producer WHERE mobile='$ph_number'";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        echo '<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="jquery.js"></script>
    <script src="state.js"></script>

    <style>

#loading-img{
display:none;
}

.response_msg{
margin-top:10px;
font-size:13px;
background:#E5D669;
color:#ffffff;
width:250px;
padding:3px;
display:none;
}
.uc{
    text-transform: uppercase;
}

.right{
    float:right;
}

</style>
</head>
<body>

<div class="container">
<div class="row">

<div class="col-md-15">
<h1><font color="green">Application For Registration /Renewal As A Silkworm Seed Cocoon Producer</font></h1>
<hr>
</div></div>
<div class="col-md-6">
<form name="contact-form" action="reg_page_2_backup.php" method="post" id="contact-form">

<div class="form-group">
    <div  >
<label for="FirstName">First Name</label>
<input type="text" class="form-control" name="first_name" maxlength="20"  value='.$user["fname"].' required>
<span class="text-danger">(Ex - Amruthboy)</label>
</div>
<br>

<div class="form-group">
    <div >
<label for="LastName">Last Name </label>
<input type="text" class="form-control" name="last_name" maxlength="20" value='.$user["lname"].' required>
<span class="text-danger">(Ex - Sanjaywadmath)</label>
</div><br>

<div class="form-group">
        <div >

<label for="fName">Name Father/ Mother/ Husband</label>
<input type="text" class="form-control" name="middle_name"  value='.$user["mname"].' required>
<span class="text-danger">(Ex-Amruth)</label>
</div></div>
<div class="form-group">
<label for="pnumber">Mobile Number</label>
<input type="varchar" class="form-control" name="pno" value='.$user["mobile"].' >
</div>


    </div>
    <div class="form-group">
    <label for="land">Land Line</label>
    <input type="number" class="form-control" name="land_line" value='.$user["land_line"].' >
    <span class="text-danger">(Ex-0802423800)</label>
    </div>


    <div class="form-group">
    <label for="door"><h3>Address :</h3></label>
    <label for="door">Door Number</label>
    <input type="varchar" class="form-control" name="addr_doorno" value='.$user["door_no"].' required>
    <span class="text-danger">(Ex-plot no 3 / Room no 201 / flat no 309)</label>
    </div>

    <div class="form-group">
    <label for="ar">Area</label>
    <input type="varchar" class="form-control" name="addr_area" value='.$user["area"].'required>
    <span class="text-danger">(Ex-Marthhalli / kengeri )</label>
</div>

<div class="form-group">
<label for="tq">Taluk</label>
<input type="varchar" class="form-control" name="addr_taluk" value='.$user["taluk"].' required>
<span class="text-danger">(Ex-Athani / Kumcha)</label>
</div>



    <div class="form-group">
        <div class="resp_code frms">
            <label for="state">Select State<br>
            <div id="selection">
            <select id="listBox"  name ="state_value" onchange="selct_district(this.value)"></select><label for="dis"><br>Select District
            <select id="secondlist" name="district_value" ></select>
        </div>
            <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                <a id="dum" style="padding-right:0px; text-decoration:none;color: green;text-align:center;"
            </div>
        </div>
    </div>

    </label>
    <br>

 <button type="nxt" class="btn btn-primary" name="Next" value="nxt" id="next_form">Next</button>
 </center>
 <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<div class="response_msg"></div>
</div>
</div>
</div>
</body>
</html>';

}
 private function checkValues(){
         if (preg_match('/[\'^£$%&*()}1234567890{@#~?>!<>,|=_+¬-]/', $this->first_name )){
            echo "<script type='text/javascript'>alert('Special Character Found in First Name');</script>";
            $var = 1;
          //  header('Refresh:1 url = page1.html');
        }
            
             if (preg_match('/[\'^£$%&*()}1234567890{@#~?>!<>,|=_+¬-]/', $this->last_name )){
            echo "<script type='text/javascript'>alert('Special char found in Middle name');</script>";$var = 1;
          //  header('Refresh:1 url = page1.html');
        }
            
             if (preg_match('/[\'^£$%&*()}{1234567890@#~?>!<>,|=_+¬-]/', $this->middle_name )){
            echo "<script type='text/javascript'>alert('Special char found in Last name');</script>";$var = 1;
        //  header('Refresh:1 url = page1.html');
        }
            
             if (preg_match('/[\'^£$%&*()}{@#~?>!<>,|=_+¬-]/', $this->land_line )){
            echo "<script type='text/javascript'>alert('Special char found in Land Line');</script>";$var = 1;
         //   header('Refresh:1 url = page1.html');
        }
                 if (preg_match('/[\'^£$%&*()}{@#~?>!<>,|=_+¬-]/', $this->addr_taluk )){
            echo "<script type='text/javascript'>alert('Special char found in Taluk');</script>";$var = 1;
         //   header('Refresh:1 url = page1.html');
        }

            if(strlen($this->ph_number) >10){
                 echo "<script type='text/javascript'>alert('Error In Phone Number');</script>";$var = 1;
          //  header('Refresh:1 url = page1.html');
            }

          }

      function startSession(){ //Start Session and SAVE VARIABLE VALUE
             session_start();
             $_SESSION['name'] = $this->ph_number ; 
             echo $this->ph_number;

         }


 function updateDB(){
    $query  = "UPDATE producer SET  fname = '$this->first_name' , lname ='$this->last_name',mname =  '$this->middle_name', land_line = '$this->land_line',door_no = '$this->addr_doorno' , area = '$this->addr_area', taluk = '$this->addr_taluk', state = '$this->state',district = '$this->district' WHERE mobile = '$this->ph_number'";
     if(mysqli_query($this->db, $query))
              echo "Database Updated   ";
          else echo "Failed while database updation";
  header("location:reg_page_4.php");}


         function startExecution($obj){
          $obj->connectDatabase();
          $obj->getValues( );        
         }
      }
  
$obj = new firstPage;
$obj->startSession();

$obj->check($_SESSION['name']);


$obj->startExecution($obj);
//echo("<script>location.href = '/reg_page_4.php';</script>");

?>
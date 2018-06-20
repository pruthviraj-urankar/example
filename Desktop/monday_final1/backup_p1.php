<?php

// initializing variables

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

      }else{
          echo "Failed :(";
            }
    }
}
       function checkAndUpdate(){
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
}

	private function checkValues(){
		 if (preg_match('/[\'^£$%&*()}1234567890{@#~?>!<>,|=_+¬-]/', $this->first_name )){
            echo "<script type='text/javascript'>alert('Special Character Found in First Name');</script>";
            $var = 1;
          	header('Refresh:1 url = page1.html');}
          	
          	 if (preg_match('/[\'^£$%&*()}1234567890{@#~?>!<>,|=_+¬-]/', $this->last_name )){
            echo "<script type='text/javascript'>alert('Special char found in Middle name');</script>";$var = 1;
          	header('Refresh:1 url = page1.html');}
          	
          	 if (preg_match('/[\'^£$%&*()}{1234567890@#~?>!<>,|=_+¬-]/', $this->middle_name )){
            echo "<script type='text/javascript'>alert('Special char found in Last name');</script>";$var = 1;
          header('Refresh:1 url = page1.html');}
          	
          	 if (preg_match('/[\'^£$%&*()}{@#~?>!<>,|=_+¬-]/', $this->land_line )){
            echo "<script type='text/javascript'>alert('Special char found in Land Line');</script>";$var = 1;
      		header('Refresh:1 url = page1.html');}
      			 if (preg_match('/[\'^£$%&*()}{@#~?>!<>,|=_+¬-]/', $this->addr_taluk )){
            echo "<script type='text/javascript'>alert('Special char found in Taluk');</script>";$var = 1;
      		header('Refresh:1 url = page1.html');}

          	if(strlen($this->ph_number) >10){
          		 echo "<script type='text/javascript'>alert('Error In Phone Number');</script>";$var = 1;
      		header('Refresh:1 url = page1.html');
          	}

          }

      function startSession(){ //Start Session and SAVE VARIABLE VALUE
             session_start();
             $_SESSION['name'] = $this->ph_number ; 
             echo $this->ph_number;

         }



         function startExecution($obj){

          $obj->connectDatabase();

          $obj->getValues( );
          
           $obj->checkValues();
           $obj->checkAndUpdate();

         }
      }



$obj = new firstPage;

$obj->startExecution($obj);
$obj->startSession();


?>

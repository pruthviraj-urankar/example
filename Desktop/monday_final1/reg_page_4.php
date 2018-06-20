<?php  

session_start();
$ph_number =$_SESSION['name'];


 function check($ph_number){

       $db = mysqli_connect('localhost', 'root', '', 'sericulture') or die("Cannot Connect To Database");
       $user_check_query = "SELECT * FROM producer WHERE mobile='$ph_number'";
       $result = mysqli_query($db,$user_check_query);
       $user = mysqli_fetch_assoc($result);
       $capacity=$user['capacity'];
       $year =$user['year_estab'];
       $dd_no =$user['dd_number'];
       $dd_date =$user['dd_date'];
       $other =$user['other_details'];

        echo '<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
p.b {
    font-family: Arial, Helvetica, sans-serif;
}

</style>
</head>
<body>
	<font size="2px">

<div class="container">
<div class="row">

<div class="col-md-18">
	<font color="green">
<h1>Application For Registration /Renewal As A Silkworm Seed Cocoon Producer</font></h1><hr>
<p class ="b">

<form name="contact-form" action="p3.php" method="post" id="contact-form">

<div class="form-group">
<div class="form-group">
	<label for="sector">Sector *(TICK)</label><br>
	<pre class="tab">
    <b><h5>

<input type="checkbox" name="sector[]" value="mulberry"> Mullberry  <input type="checkbox" name="sector[]" value="tasar"> Tasar     <input type="checkbox" name="sector[]" value="otasar"> Oak Tasar    <input type="checkbox" name="sector[]" value="eri"> Eri   <input type="checkbox" name="sector[]" value="muga"> Muga</b> </h5></pre>
</div>

<div class="form-group">
	<label for="sector">Applicant type *(TICK)</label><br>
	<pre class="tab"><b><h5>
<input type="radio" name="govt" value="government"> Government  <input type="radio" name="govt" value="private"> Private     <input type="radio" name="govt" value="ngo"> NGOs</b> </h5></pre>
</div>

<div class="form-group">
	<label for="sector">Rearing House Ownership *(TICK)</label><br>
	<pre class="tab"><b><h5>
<input type="radio" name="own" value="own"> Own  <input type="radio" name="own" value="leased"> Leased     <input type="radio" name="own" value="rented"> Rented </b> </h5></pre>

<div class="form-group">
	<label for="sector">Mulbery garden/host plant *(TICK)</label><br>
	<pre class="tab"><b><h5>
<input type="radio" name="ow" value="own"> Own  <input type="radio" name="ow" value="leased"> Leased </b> </h5></pre>

<div class="form-group">
<label for="capacity">Capacity of the reaaring house</label>
<input type="text" class="form-control" name="capacity" value = '.$capacity.' required>
</div>

<div class="form-group">
	<label for="sector">Mulbery/Host plant *(TICK)</label><br>
	<pre class="tab"><b><h5>
<input type="checkbox" name="acr[]" value="acerage"> Acreage  <input type="checkbox" name="acr[]" value="variety"> Variety </b> </h5></pre>

<div class="form-group">
	<label for="sector">Year Of Established</label><br></div>
	<pre class="tab"><b><h5>
Year<input type="number" name="yr" value = '.$year.'></b> </h5></pre></b></pre></div>
<div class="form-group">
	<label for="sector">Demand Draft Number And Date</label><br></div>
	<pre class="tab"><b><h5>
D/D Number  <input type="number" name="dd" value = '.$dd_no.'> Date <input type="date" name="dt" value='.$dd_date.'>  </b> </h5></pre></b></pre><br>
<div class="form-group">
	<label for="sector">Any Others Details</label></div>
	<pre class="tab"><b><h5>
Other Deatils<textarea name="text1" cols="40" rows="3" class="form-control" name="dt" value ='.$other.'></textarea>
 </b> </h5></pre></b></pre>
</p>



<button type="submit" form="contact-form" class="btn btn-primary" name="Next_2" value="Submit">Submit</button>
</div>
</div>
</div>

</body>
</html>
';
   
    }






check($ph_number);




		if (isset($_POST['Next_2']))
		{


		$chkbox =$_POST['sector'];

 		$chkNew = "";

 		foreach($chkbox as$chkNew1)
 		{
 			$chkNew .=$chkNew1 . ",";
 		}

			$app_type =$_POST['govt'];
		//	echo "  Application type ==:".$app_type ;
			$rear_h_own =$_POST['own'];
		//	echo "  Rearing house ==".$rear_h_own;
			$gar =$_POST['ow'];
	//		echo "  garden :==".$gar;
			$capacity =$_POST['capacity'];
	//		echo "  Capasity ==:".$capacity;

		$plant =$_POST['acr'];

 		$New_plant = "";

 		foreach($plant as$chkNew1_plant)
 		{
 		$New_plant .=$chkNew1_plant . ",";
 		}
 		echo "NEW PLANT : ". $New_plant;


		   $year_est = mysqli_real_escape_string($db,$_POST['yr']);
		   $dd_no = mysqli_real_escape_string($db,$_POST['dd']);
			 $dd_date = mysqli_real_escape_string($db,$_POST['dt']);
			 echo $dd_date;
			 $other = mysqli_real_escape_string($db,$_POST['text1']);

	




	
  		$query = "UPDATE producer SET sector = '$chkNew',app_type = '$app_type' ,
		 house_owner = '$rear_h_own', other_details ='$other', dd_number = '$dd_no', dd_date = '$dd_date',year_estab = '$year_est',
		  host_plant_1 = '$gar', capacity = '$capacity' ,
		  host_plant_2 = '$New_plant' WHERE mobile = '$ph_number '  ";
 		if(mysqli_query($db,$query))
 		echo "DataBase Updated :)";
		else echo "Failed while updating :(";
		header('location: pdf_generate.php');
			
			}







?>
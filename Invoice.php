<?php

if(isset($_POST['submit']))
{
// getting all values from the HTML form
   
        $mrno = $_POST['mrno'];
        $name1 = $_POST['name1'];
        $age1 = $_POST['age1'];
        $mobno = $_POST['mobno'];
        $gender1 = $_POST['gender1'];     
        $pcatagry = $_POST['pcatagry'];
        $deprtmnt = $_POST['deprtmnt'];
        $bilno = $_POST['bilno'];
        $bildate = $_POST['bildate'];
        $modpyment = $_POST['modpyment'];
        $totbil = $_POST['totbil'];
        $adv11 = $_POST['adv11'];
        $netpayable1 = $_POST['netpayable1'];
        $payrecved = $_POST['payrecved'];
        $netpay1 = $_POST['netpay1'];
        $abc = $_POST['abc']; 

        $scode =  $_POST['scode'];
       	$docname =  $_POST['docname'];
        $machno =  $_POST['machno'];
	 $qty =  $_POST['qty'];
        $price1 =  $_POST['price1'];
	 $discunt =  $_POST['discunt'];
        $tot4 =  $_POST['tot4'];
        $tech1=  $_POST['tech1'];
  	$remarks3=  $_POST['remarks3'];
	$zzz1=  $_POST['zzz1'];
	$zzz2=  $_POST['zzz2'];
	$zzz3=  $_POST['zzz3'];	
}


 // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hmis";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
$sqlInsert = "INSERT INTO iap3 (mrno, name1, age1, mobno, gender1,  pcatagry, deprtmnt, bilno, bildate, modpyment,  totbil, adv11, netpayable1, payrecved, netpay1, uname1) 
			 VALUES ('$mrno', '$name1', '$age1', '$mobno', '$gender1', '$pcatagry', '$deprtmnt', '$bilno', '$bildate', '$modpyment',  '$totbil', '$adv11', '$netpayable1', '$payrecved', '$netpay1', '$abc')";		
		   $rs = mysqli_query($con, $sqlInsert);

    $last_id = mysqli_insert_id($con);
  
for ($i = 0; $i < count($scode); $i++) {
			$sqlInsertItem = "
			INSERT INTO iap4(pid, scode, docname, machno, qty, price1, discunt, tot4, tech1, remarks3, zzz1, zzz2, zzz3) 
			VALUES (' $last_id', '$scode[$i]',  '$docname[$i]', '$machno[$i]', '$qty[$i]', '$price1[$i]', '$discunt[$i]', '$tot4[$i]', '$tech1[$i]', '$remarks3[$i]', '$zzz1[$i]', '$zzz2[$i]', '$zzz3[$i]')";			
			$rs1 = mysqli_query($con, $sqlInsertItem);
		}       	

  
    // close connection
    mysqli_close($con);



?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />
</head>

<body>




<div class="height50 first50">





<center>
<img src =logo.png width =220 height = 100>
<p>Plot No 10, Stno:25A, Off Stno:22 F6-2 Islamabad, Pakistan</p>
<hr width = "80%">
<br>
<style>



table.center {
  margin-left: auto; 
  margin-right: auto;

}
</style>
<table class="center" border=0  width=600>
<tr><td><b>Mrno : </td><td><?php echo $_POST["mrno"]; ?></td><td><b>Name : </td><td><?php echo $_POST["name1"]; ?></td></tr>
<tr><td><b>Bill No : </td><td><?php echo $_POST["bilno"]; ?></td><td><b>Bill Date : </td><td><?php echo date('d-M-Y', strtotime($_POST['bildate'])); ?></td></tr>
<tr><td><b>Mod of Payment : </td><td><?php echo $_POST["modpyment"]; ?></td><td><b>Mobile No : </td><td><?php echo $_POST["mobno"]; ?></td></tr>
</table>


<br>





<table style="line-height: 1.5;" width = 600>
<tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Service</td>
<td style="text-align:center;border:1px solid #cccccc;width:300px;"><b>Consultant</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Rate</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Discount</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Total</td></tr>
<?php 

 for ($i=0;$i<count($_POST['scode']);$i++) {
 echo "<tr>";
echo '<td style = "text-align:left; border:1px solid #cccccc;">'.$_POST['scode'][$i].'</td>';
echo '<td style = "text-align:left; border:1px solid #cccccc;">'.$_POST['docname'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['price1'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['discunt'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['tot4'][$i].'</td>';
} 
 ?>

</table>

<br>
<table class="center" border=0  width=600>
<tr><td width =200></td><td  width =200></td><td><b>Total Bill<td><?php echo $_POST["totbil"]; ?></td></tr>
<tr><td width =175></td><td width =175></td><td><b>Net Payable</td><td><?php echo $_POST["netpayable1"]; ?></td></tr>
<tr><td width =175></td width =175><td></td><td><b>Amount Recieved </td><td><?php echo $_POST['payrecved']; ?></td></tr>
<tr><td width =175><b>Prepared By</td width =175><td></td><td></td><td></td></tr>
</table>




</div>
<div class="height50 second50">
    <style>
img {
    margin-top:10px;
}

</style>
<center>
<img src =logo.png width =220 height = 100>
<p>Plot No 10, Stno:25A, Off Stno:22 F6-2 Islamabad, Pakistan</p>
<hr width = "80%">
<br>
<style>

 table.border{
 
  border-style: dotted;
}

table.center {
  margin-left: auto; 
  margin-right: auto;

}
</style>
<table class="center" border=0  width=600>
<tr><td><b>Mrno : </td><td><?php echo $_POST["mrno"]; ?></td><td><b>Name : </td><td><?php echo $_POST["name1"]; ?></td></tr>
<tr><td><b>Bill No : </td><td><?php echo $_POST["bilno"]; ?></td><td><b>Bill Date : </td><td><?php echo date('d-M-Y', strtotime($_POST['bildate'])); ?></td></tr>
<tr><td><b>Mod of Payment : </td><td><?php echo $_POST["modpyment"]; ?></td><td><b>Mobile No : </td><td><?php echo $_POST["mobno"]; ?></td></tr>
</table>


<br>





<table style="line-height: 1.5;" width = 600>
<tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Service</td>
<td style="text-align:center;border:1px solid #cccccc;width:300px;"><b>Consultant</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Rate</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Discount</td>
<td style="text-align:center;border:1px solid #cccccc;width:180px;"><b>Total</td></tr>
<?php 

 for ($i=0;$i<count($_POST['scode']);$i++) {
 echo "<tr>";
echo '<td style = "text-align:left; border:1px solid #cccccc;">'.$_POST['scode'][$i].'</td>';
echo '<td style = "text-align:left; border:1px solid #cccccc;">'.$_POST['docname'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['price1'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['discunt'][$i].'</td>';
echo '<td style = "text-align:center; border:1px solid #cccccc;">'.$_POST['tot4'][$i].'</td>';
} 
 ?>

</table>

<br>
<table class="center" border=0  width=600>
<tr><td width =200></td><td  width =200></td><td><b>Total Bill<td><?php echo $_POST["totbil"]; ?></td></tr>
<tr><td width =175></td><td width =175></td><td><b>Net Payable</td><td><?php echo $_POST["netpayable1"]; ?></td></tr>
<tr><td width =175></td width =175><td></td><td><b>Amount Recieved </td><td><?php echo $_POST['payrecved']; ?></td></tr>
<tr><td width =175><b>Prepared By</td width =175><td></td><td></td><td></td></tr>
</table>

</div>

</body></html>




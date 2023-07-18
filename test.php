
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Bill</title> 

	<script src=
		"https://code.jquery.com/jquery-3.2.1.min.js">
	</script>

	<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		type="text/javascript">
	</script>
	
	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>

   
        <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.2.slim.js" integrity="sha256-OflJKW8Z8amEUuCaflBZJ4GOg4+JnNh9JdVfoV+6biw=" crossorigin="anonymous"></script>
    
   

</head>
  <body>

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hmis";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
$query = "SELECT mrno FROM iap3 ORDER BY mrno DESC";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$lastid = $row['mrno'];
if(empty($lastid))
{
    $number1 = "F-00001";
}
else
{
    $idd = str_replace("F-", "", $lastid);
    $id = str_pad($idd + 1, 5, 0, STR_PAD_LEFT);
    $number1 = 'F-'.$id;
}
?>

<?php
$query = "SELECT bilno FROM iap3 ORDER BY bilno DESC";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$lastid = $row['bilno'];
if(empty($lastid))
{
    $number = "B-00001";
}
else
{
    $idd = str_replace("B-", "", $lastid);
    $id = str_pad($idd + 1, 5, 0, STR_PAD_LEFT);
    $number = 'B-'.$id;
}
?>

    <div class="container ">
       <div class="panel panel-default">
 <div class="panel-heading" style="background-color: #3fbbc0;"><h4>Patient Bill</h4></div>   
              
             <div class="panel-body">
	<form method="POST" action="invoice.php"  target="_blank">
            <div class="card-body">

               
                            
                            
                        </div>
            
                       <div class="row"> <div class="col-lg-4"> <div class="form-group">
		<label>MR No:</label> <input type="text" name= "mrno"  id= "mrno" value="<?php echo $number1; ?>" class="form-control" Required>
		</div> </div> 
<div class="col-lg-4"> <div class="form-group">
		<label>Name:</label> <input type="text" name= "name1"  id= "name1" class="form-control" Required>
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Age :</label> <input type="text" name= "age1"  id= "age1" class="form-control">
		</div> </div></div>

<div class="row"> <div class="col-lg-4"> <div class="form-group">
				<label>Gender:</label> <Select name="gender1"  id='gender1'  class="form-control">

<option value="">Select Gender</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM gender");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['gen1'].'">'.$row['gen1'].'</option>';
} ?>



</select>
		</div> </div> 
<div class="col-lg-4"> <div class="form-group">
		<label>Mobile:</label> <input type="text" name= "mobno"  id= "mobno" class="form-control"  Required>
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Patient Catagory:</label> <Select name="pcatagry"  id='pcatagry' class="form-control">

<option value="Private">Private</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM pc");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['pc1'].'">'.$row['pc1'].'</option>';
} ?>



</select>
		</div> </div></div>

<div class="row"> <div class="col-lg-4"> <div class="form-group">
		<label>Department :</label> <Select name= "deprtmnt"  id= "deprtmnt" class="form-control">
<option value="OPD">OPD</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM maind");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['mainddd'].'">'.$row['mainddd'].'</option>';
} ?>



</select>
		</div> </div> 
<div class="col-lg-4"> <div class="form-group">
		<label>Bill No:</label> <input type="text" name= "bilno"  id= "bilno" class="form-control" value="<?php echo $number; ?>" readonly style="background-color: #3fbbc0;">
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Bill Date:</label> <input type="date" value = "<?php echo date("Y-m-d"); ?>" name= "bildate"  id= "bildate" class="form-control" readonly style="background-color: #3fbbc0;">
		</div> </div></div>



                <table class="table table-bordered">
                    <thead class="table-success" style="background-color: #3fbbc0;">
                      <tr>
                        
                        <th width="15%"><center>Service</th>
                        <th width="10%"><center>Mach No</th>
			<th width="10%"><center>Consultant</th> 
			<th width="5%"><center>Qty</th>                       
			<th width="10%"><center>Rate</th>
			<th width="10%"><center>Discount</th>			
			<th width="10%"><center>Total</th>
			<th width="15%"><center>Technition</th>
			<th width="20%"><center>Remarks</th>
			<th width="5%"></th>

                                               
                            <button type="button" class="btn btn-sm btn-success" onclick="BtnAdd()">+</button>
                          
                        </th>

                      </tr>
                    </thead>
                    <tbody id="TBody">
                      <tr id="TRow" class="d-none">
                       
       <td><input type="text"  class="scode form-control text-end" name="scode[]" id = "tutorial_name"   onchange="GetDetail(this.closest('tr'))"></td>

 
				
                         
   			 			<td><Select class="form-control text-end" name="machno[]" id="hhh" Required>
<option value="One">One</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM mmmach");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['mach1'].'">'.$row['mach1'].'</option>';
} ?>
</select></td>

			<td><Select class="form-control text-end" name="docname[]" id="iii" required>
<option value="">Select Consult</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM consultant");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['consultant_name'].'">'.$row['consultant_name'].'</option>';
} ?>
</select></td>
			<td><input type="text" class="qty form-control text-end" name="qty[]" id="ccc" onfocus="Calc(this);"></td>
			<td><input type="text" class="price form-control text-end" name="price1[]" id="ddd"   onfocus="Calc(this);" readonly style="background-color: #3fbbc0;"></td>
			<td><input type="text" class="discunt form-control text-end" name="discunt[]"  id="eee" onchange="Calc(this);"></td>
			
                        
			
                        <td><input type="text" class="tot4 form-control text-end" name="tot4[]" id="fff"  readonly style="background-color: #3fbbc0;"></td>
			<td><Select class="form-control text-end" name="tech1[]" id="ggg" Required>
<option value="">Select Technition</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM tech1");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['techname'].'">'.$row['techname'].'</option>';
} ?>
</select></td>
<td><input type="text" class="form-control text-end" name="remarks3[]"  id="zzz" ><input type="hidden" class="zzz1 form-control text-end" name="zzz1[]"  id="zzz1" ><input type="hidden" class="zzz2 form-control text-end" name="zzz2[]"  id="zzz2" ><input type="hidden" class="zzz3 form-control text-end" name="zzz3[]"  id="zzz3" ></td>
                        <td class="NoPrint"><button type="button" class="btn btn-success"  style="line-height: 1;" onclick="BtnDel(this)">x</button></td>
  
                 
			
                      </tr>
                    </tbody>
 
        
                  </table>
<script>

		// onkeyup event will occur when the user
// release the key and calls the function
// assigned to this event
function GetDetail(row) {
  let str = row.querySelector(".scode").value;
  if (str.length == 0) {
      row.querySelector(".qty").value = "";
    row.querySelector(".price").value = "";
    row.querySelector(".discunt").value = "";
    row.querySelector(".tot4").value = "";
	row.querySelector(".zzz1").value = "";
	row.querySelector(".zzz2").value = "";
	row.querySelector(".zzz3").value = "";
    return;
  } else {
    // Creates a new XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

      // Defines a function to be called when
      // the readyState property changes
      if (this.readyState == 4 &&
        this.status == 200) {

        // Typical action to be performed
        // when the document is ready
        var myObj = JSON.parse(this.responseText);

        // Returns the response data as a
        // string and store this array in
        // a variable assign the value
        // received to first name input field

       
        row.querySelector(".qty").value = myObj[0];
        row.querySelector(".price").value = myObj[1];
       row.querySelector(".discunt").value = myObj[2];	
       row.querySelector(".tot4").value = myObj[3];
	 row.querySelector(".zzz1").value = myObj[4];
 	row.querySelector(".zzz2").value = myObj[5];
 	row.querySelector(".zzz3").value = myObj[6];
      }
    };

    // xhttp.open("GET", "filename", true);
    xmlhttp.open("GET", "gfg.php?user_id=" + str, true);

    // Sends the request to the server
    xmlhttp.send();
  }
}
	</script>

                  
                    


                    </div>
                </div>
             
          

<div class="row"> <div class="col-lg-4"> <div class="form-group">
		<label>Mode of Payment:</label> <Select name= "modpyment"  id= "modpyment" class="form-control" Required>
<option value="">Select Mode</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM mod1");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['ppp1'].'">'.$row['ppp1'].'</option>';
} ?>
</select>


		</div> </div> 


<div class="col-lg-4"> <div class="form-group">
		<label>Total Bill:</label> <input type="text" name= "totbil"  id= "totbil" class="form-control" readonly style="background-color: #3fbbc0;">
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Advance Received:</label> <input type="text" name= "adv11"  id= "adv11" class="form-control"  onchange="GetTotal()" readonly style="background-color: #3fbbc0;">
		</div> </div> 

</div>

<div class="row"> 
<div class="col-lg-4"> <div class="form-group">
		<label>Net Payable:</label> <input type="text" name= "netpayable1"  id= "netpayable1" class="form-control" readonly style="background-color: #3fbbc0;">
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Net Payable Received:</label> <input type="text" name= "payrecved"  id= "payrecved" class="form-control"  onchange="GetTotal()" Required>
		</div> </div>
<div class="col-lg-4"> <div class="form-group">
		<label>Balance:</label> <input type="text" name= "netpay1"  id= "netpay1" class="form-control" readonly style="background-color: #3fbbc0;">
		</div> </div></div>

<div class="row"> 
<div class="col-lg-4"> <div class="form-group">
		<label>Operator:</label><input type="text" name="abc" id="abc"  readonly class="form-control" value = "<?php echo htmlspecialchars($_SESSION["username"]); ?>"  style="background-color: #3fbbc0;">
		</div> </div>
</div>

<div class="row">

<div class="col-lg-4"> <div class="form-group">
		<label></div></div>

<div class="col-lg-4"> <div class="form-group">
		<label></div></div>
 <div class="col-lg-4"> <div class="form-group"><center>
		<input type="submit" name="submit" id="submit" value="Submit"  class="btn btn-success submit_btn invoice-save-btm">	
			

</form>
    
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="frontend-script.js"></script>
 


    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 

 

</div>


 </body>
</html>


<script type="text/javascript">

function GetPrint()
{
    /*For Print*/
    window.print();
}

function BtnAdd()
{
    /*Add Button*/
    var v = $("#TRow").clone().appendTo("#TBody") ;
    $(v).find("input").val('');
    $(v).removeClass("d-none");
    $(v).find("th").first().html($('#TBody tr').length - 1);
}

function BtnDel(v)
{
    /*Delete Button*/
       $(v).parent().parent().remove(); 
       GetTotal();

        $("#TBody").find("tr").each(
        function(index)
        {
           $(this).find("th").first().html(index);
        }

       );
}



function Calc(v)
{
    /*Detail Calculation Each Row*/
    var index = $(v).parent().parent().index();
    
    var qqq1 = document.getElementsByName("qty[]")[index].value;
    var rrr1 = document.getElementsByName("price1[]")[index].value;
    var ddd1 = document.getElementsByName("discunt[]")[index].value;    
     var tot4  =  +qqq1 * +rrr1 - +ddd1 

    document.getElementsByName("tot4[]")[index].value = tot4;

    GetTotal();
}

function GetTotal()
{
    /*Footer Calculation*/   

    var sum=0;
    var amts =  document.getElementsByName("tot4[]");

    for (let index = 0; index < amts.length; index++)
    {
        var tot4 = amts[index].value;
        sum = +(sum) +  +(tot4) ; 
    }

    document.getElementById("totbil").value = sum;

    var gst =  document.getElementById("adv11").value;
    var net = +(sum) - +(gst);
    document.getElementById("netpayable1").value = net;

	var gst1 =  document.getElementById("payrecved").value;
	var net1 = +(net) - +(gst1);
        document.getElementById("netpay1").value = net1;

}
</script>
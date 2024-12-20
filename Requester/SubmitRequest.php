<?php
define('TITLE', 'Submit Request');
define('PAGE', 'SubmitRequest');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RequesterLogin.php'; </script>";
}
if(isset($_REQUEST['submitrequest'])){
 // Checking for Empty Fields
 if(($_REQUEST['requestinfo'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesteradd1'] == "") || ($_REQUEST['requesteradd2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
 } else {
   // Assigning User Values to Variable
   $rinfo = $_REQUEST['requestinfo'];
   $rdesc = $_REQUEST['requestdesc'];
   $rname = $_REQUEST['requestername'];
   $radd1 = $_REQUEST['requesteradd1'];
   $radd2 = $_REQUEST['requesteradd2'];
   $rcity = $_REQUEST['requestercity'];
   $rstate = $_REQUEST['requesterstate'];
   $rzip = $_REQUEST['requesterzip'];
   $remail = $_REQUEST['requesteremail'];
   $rmobile = $_REQUEST['requestermobile'];
   $rdate = $_REQUEST['requestdate'];
   $sql = "INSERT INTO submitrequest_tb(request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date) VALUES ('$rinfo','$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmobile', '$rdate')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $genid = mysqli_insert_id($conn);
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Request Submitted Successfully Your ' . $genid .' </div>';
    session_start();
    $_SESSION['myid'] = $genid;
    echo "<script> location.href='submitrequestsuccess.php'; </script>";
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
   }
 }
}
?>
<div class="col-sm-9 col-md-10 mt-5" style="background-color:#d8f3fc; padding: 40px 30px; border-radius: 10px; box-shadow: 0 6px 12px rgba(0,0,0,0.1);">
  <h2 class="mb-4 text-center" style="color: #333; font-weight: 600;">Submit Your Request</h2>
  <form class="mx-5 p-4" action="" method="POST" style="background-color: #d8f3fc; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <div class="form-group">
      <label for="inputRequestInfo" style="font-weight: bold;">Request Info</label>
      <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo" style="border-radius: 8px; font-size: 16px;">
    </div>
    <div class="form-group">
      <label for="inputRequestDescription" style="font-weight: bold;">Description</label>
      <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc" style="border-radius: 8px; font-size: 16px;">
    </div>
    <div class="form-group">
      <label for="inputName" style="font-weight: bold;">Name</label>
      <input type="text" class="form-control" id="inputName" placeholder="Name" name="requestername" style="border-radius: 8px; font-size: 16px;">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress" style="font-weight: bold;">Address Line 1</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="House No. 123" name="requesteradd1" style="border-radius: 8px; font-size: 16px;">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2" style="font-weight: bold;">Address Line 2</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Railway Colony" name="requesteradd2" style="border-radius: 8px; font-size: 16px;">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity" style="font-weight: bold;">City</label>
        <input type="text" class="form-control" id="inputCity" name="requestercity" style="border-radius: 8px; font-size: 16px;">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState" style="font-weight: bold;">State</label>
        <input type="text" class="form-control" id="inputState" name="requesterstate" style="border-radius: 8px; font-size: 16px;">
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip" style="font-weight: bold;">Zip</label>
        <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)" style="border-radius: 8px; font-size: 16px;">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail" style="font-weight: bold;">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="requesteremail" style="border-radius: 8px; font-size: 16px;">
      </div>
      <div class="form-group col-md-2">
        <label for="inputMobile" style="font-weight: bold;">Mobile</label>
        <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)" style="border-radius: 8px; font-size: 16px;">
      </div>
      <div class="form-group col-md-2">
        <label for="inputDate" style="font-weight: bold;">Date</label>
        <input type="date" class="form-control" id="inputDate" name="requestdate" style="border-radius: 8px; font-size: 16px;">
      </div>
    </div>

    <button type="submit" class="btn btn-danger btn-lg" name="submitrequest" style="width: 180px; padding: 12px 20px; font-size: 16px; border-radius: 8px; text-align: center;">Submit</button>
    <button type="reset" class="btn btn-secondary btn-lg" style="width: 180px; padding: 12px 20px; font-size: 16px; border-radius: 8px; text-align: center;">Reset</button>
  </form>
  <?php if(isset($msg)) {echo $msg; } ?>
</div>

<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>

<?php
include('includes/footer.php'); 
$conn->close();
?>

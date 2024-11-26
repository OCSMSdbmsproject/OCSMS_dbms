<?php    
define('TITLE', 'Product Sell Success');
define('PAGE', 'assets');
include('includes/header.php'); 
include('../dbConnection.php'); 
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}

if(isset($_SESSION['myid'])) {
    $id = $_SESSION['myid'];
    $sql = "SELECT * FROM customer_tb WHERE custid = $id";
    $result = $conn->query($sql);
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script> location.href='sellproduct.php'; </script>";
    }
} else {
    echo "<script> location.href='sellproduct.php'; </script>";
}
?>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Product Sold Successfully</h3>
    <table class="table">
        <tbody>
            <tr>
                <th>Customer ID</th>
                <td><?php echo $row['custid']; ?></td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td><?php echo $row['custname']; ?></td>
            </tr>
            <tr>
                <th>Customer Address</th>
                <td><?php echo $row['custadd']; ?></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?php echo $row['cpname']; ?></td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td><?php echo $row['cpquantity']; ?></td>
            </tr>
            <tr>
                <th>Price Each</th>
                <td><?php echo $row['cpeach']; ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?php echo $row['cptotal']; ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><?php echo $row['cpdate']; ?></td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="assets.php" class="btn btn-secondary">Close</a>
    </div>
</div>
<?php
include('includes/footer.php'); 
?>

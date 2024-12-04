<?php
define('TITLE', 'Technician');
define('PAGE', 'technician');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <!-- Table -->
  <p class="bg-dark text-white p-3 mb-4 rounded shadow-lg">List of Technicians</p>
  <?php
    $sql = "SELECT * FROM technician_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo '<table class="table table-hover table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">Emp ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">City</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Email</th>
                  <th scope="col">Notify</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>';
      while($row = $result->fetch_assoc()){
        echo '<tr>';
        echo '<th scope="row">'.$row["empid"].'</th>';
        echo '<td>'. $row["empName"].'</td>';
        echo '<td>'.$row["empCity"].'</td>';
        echo '<td>'.$row["empMobile"].'</td>';
        echo '<td>'.$row["empEmail"].'</td>';
        echo '<td>
                <button class="btn btn-warning leave-message-btn" data-empid="'.$row["empid"].'" data-empname="'.$row["empName"].'">
                  <i class="fas fa-comments"></i> Leave Message
                </button>
              </td>';
        echo '<td>
                <form action="editemp.php" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["empid"] .'>
                  <button type="submit" class="btn btn-info mr-2" name="view" value="View"><i class="fas fa-pen"></i> Edit</button>
                </form>
                <form action="" method="POST" class="d-inline">
                  <input type="hidden" name="id" value='. $row["empid"] .'>
                  <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i> Delete</button>
                </form>
              </td>';
        echo '</tr>';
      }
      echo '</tbody>
            </table>';
    } else {
      echo "<p class='text-danger'>No Technicians Found</p>";
    }
    if(isset($_REQUEST['delete'])){
      $sql = "DELETE FROM technician_tb WHERE empid = {$_REQUEST['id']}";
      if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
      } else {
        echo "<p class='text-danger'>Unable to Delete Data</p>";
      }
    }
  ?>
</div>

<!-- Leave Message Modal -->
<div class="modal fade" id="leaveMessageModal" tabindex="-1" aria-labelledby="leaveMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="leaveMessageModalLabel">Leave a Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="leaveMessageForm">
          <input type="hidden" id="technician_id" name="technician_id">
          <div class="mb-3">
            <label for="technician_name" class="form-label">Technician Name</label>
            <input type="text" id="technician_name" class="form-control" readonly>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Open the modal and populate the form
  document.querySelectorAll('.leave-message-btn').forEach(button => {
    button.addEventListener('click', () => {
      const empid = button.getAttribute('data-empid');
      const empname = button.getAttribute('data-empname');
      document.getElementById('technician_id').value = empid;
      document.getElementById('technician_name').value = empname;
      new bootstrap.Modal(document.getElementById('leaveMessageModal')).show();
    });
  });

  // Handle the form submission
  document.getElementById('leaveMessageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('savemessage.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        alert(data);
        const modal = bootstrap.Modal.getInstance(document.getElementById('leaveMessageModal'));
        modal.hide();
        location.reload();
      });
  });
</script>

<!-- Add Technician Button -->
<div class="text-center mt-3">
  <a href="insertemp.php" class="btn btn-danger btn-lg rounded-circle box shadow-lg"> <!-- Changed from btn-success to btn-danger for red color -->
    <i class="fas fa-plus fa-2x"></i>
  </a>
</div>

<?php
include('includes/footer.php'); 
?>
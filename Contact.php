<div class="container my-5" id="Contact">
  <div class="row g-4 align-items-start">
    <!-- Contact Form Column -->
    <div class="col-md-8">
      <form id="contactForm" action="process_contact.php" method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
      </form>
      
      <!-- Success Message Placeholder -->
      <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success mt-3" role="alert">
          <?= $_SESSION['message']; ?>
          <?php unset($_SESSION['message']); ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Contact Information Column -->
    <div class="col-md-4">
      <div class="p-4 rounded shadow" style="background-color: #80deea; color: black;">
        <h4 class="text-center mb-4" style="color: black;">Our Offices</h4>

        <!-- Headquarter -->
        <div class="office-info mb-4">
          <h5 class="fw-bold" style="color: black;">Headquarter</h5>
          <p>FixIT Pvt Ltd, <br>Sec IV, Valencia <br>Mangalore - 575001</p>
          <p>Phone: 8660516530 </p>
          <a href="#" target="_blank" class="text-dark text-decoration-none">www.fixit.com</a>
        </div>

        <!-- Manipal Branch -->
        <div class="office-info">
          <h5 class="fw-bold" style="color: black;">Manipal Branch</h5>
          <p>FixIT Pvt Ltd, <br>4th cross, Shanti Nagar <br>Manipal - 576107</p>
          <p>Phone: 8618010600 </p>
          <a href="#" target="_blank" class="text-dark text-decoration-none">www.fixit.com</a>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
    /* Contact Form Styling */
#contactForm {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Form Labels */
#contactForm .form-label {
    font-weight: bold;
    color: #333;
}

/* Input Fields Styling */
#contactForm .form-control {
    border-radius: 8px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px;
    padding: 10px;
    font-size: 16px;
}

/* Input Focus State */
#contactForm .form-control:focus {
    border-color: #80deea;
    box-shadow: 0 0 5px rgba(128, 222, 234, 0.7);
}

/* Submit Button Styling */
#contactForm .btn {
    background-color: #80deea;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

/* Submit Button Hover Effect */
#contactForm .btn:hover {
    background-color: #4db6ac;
    cursor: pointer;
}

</style>
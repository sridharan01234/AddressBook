function validateRegisterForm() {
  document.getElementById('error').style.display = "none";
    if (
      document.getElementById("floating_first_name").value == "" ||
      document.getElementById("floating_last_name").value == "" ||
      document.getElementById("floating_email").value == "" ||
      document.getElementById("floating_password").value == "" ||
      document.getElementById("floating_repeat_password").value == ""
    ) {
      document.getElementById('error').style.display = "block";
      document.getElementById('error').innerHTML = "All the fields must be filled";
      return false;
    }
  }
function validateLoginForm() {
  if (
    document.getElementById("email").value == "" ||
    document.getElementById("password").value == ""
  ) {
    document.getElementById('error').style.display = "block";
    document.getElementById('error').innerHTML = "All the fields must be filled";
    return false;
  }
}

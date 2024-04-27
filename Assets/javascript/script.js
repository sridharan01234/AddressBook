function validateRegisterForm() {
  if (
    document.getElementById("inputFirstName").value == "" ||
    document.getElementById("inputLastName").value == "" ||
    document.getElementById("inputEmail").value == "" ||
    document.getElementById("inputPassword").value == "" ||
    document.getElementById("ConfirmPassword").value == ""
  ) {
    alert("All the Fields must be Filled");
    return false;
  }
  // console.log(document.getElementById("inputFirstName").value);
  // console.log(document.getElementById("inputLastName").value);
  // console.log(document.getElementById("inputEmail").value);
  // console.log(document.getElementById("inputPassword").value);
  // console.log(document.getElementById("ConfirmPassword").value);
}

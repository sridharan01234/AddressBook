function validateRegisterForm() {
  document.getElementById("error").style.display = "none";
  if (
    document.getElementById("floating_first_name").value == "" ||
    document.getElementById("floating_last_name").value == "" ||
    document.getElementById("floating_email").value == "" ||
    document.getElementById("floating_password").value == "" ||
    document.getElementById("floating_repeat_password").value == ""
  ) {
    document.getElementById("error").style.display = "block";
    document.getElementById("error").innerHTML = "All the fields must be filled";
    shakeForm();
    return false;
  }
  if (
    document.getElementById("floating_password").value !==
    document.getElementById("floating_repeat_password").value
  ) {
    document.getElementById("error").style.display = "block";
    document.getElementById("error").innerHTML = "Password does not match";
    shakeForm();
    return false;
  }
}

function shakeForm() {
  var margin = 15;
  var speed = 10;
  var times = 3;
  for (var i = 0; i < times; i++) {
    $("form").animate(
      { "margin-left": "+=" + (margin = -margin) + "px" },
      speed
    );
    $("form").animate(
      { "margin-right": "+=" + (margin = -margin) + "px" },
      speed
    );
    $("form").animate(
      { "margin-right": "+=" + (margin = -margin) + "px" },
      speed
    );
    $("form").animate(
      { "margin-left": "+=" + (margin = -margin) + "px" },
      speed
    );
  }
}

function verifyUser(email) {
  $.ajax({
    url: "verifyUser",
    type: "GET",
    data: { email: email },
    success: function (response) {
      if (response === "exists") {
        $("#error-message").text("User exists");
      } else {
        $("#error-message").text("");
      }
    },
    error: function () {
      $("#error-message").text("Failed to verify user");
    }
  });
}

$("#email").on("blur", function () {
  if ($(this).val() === "") {
    $("#error-message").text("Email field cannot be empty");
  } else {
    verifyUser($(this).val());
  }
});

$("#register-form").validate({
  rules: {
    first_name: "required",
    last_name: "required",
    email: {
      required: true,
      email: true,
    },
    password: {
      strongPassword: true,
      required: true,
      minlength: 8,
    },
    repeat_password: {
      required: true,
      minlength: 8,
      equalTo: "#password",
    },
  },
  messages: {
    first_name: "This field is required",
    last_name: "This field is required",
    email: {
      required: "This field is required",
      email: "Please enter a valid email address",
    },
    password: {
      required: "This field is required",
      minlength: "Minimum 8 characters required",
    },
    repeat_password: {
      required: "This field is required",
      minlength: "Minimum 8 characters required",
      equalTo: "Password does not match",
    },
  },
});
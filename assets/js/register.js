$.validator.addMethod("verifyUser", function(value, element) {
  var email = value;
  var response = false;
  $.ajax({
    url: 'verifyUser',
    method: 'GET',
    data: { email: email },
    async: false,
    success: function(result) {
      response = (result === 'exists');
    },
    error: function() {
      response = false;
    }
  });
  return !response;
});


$("#register-form").validate({
  rules: {
    first_name: "required",
    last_name: "required",
    email: {
      required: true,
      email: true,
      verifyUser: true
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
      verifyUser: "User exists",
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

setTimeout(function() {
  $("#error, #message").hide("slow");
}, 5000);
$("#register-form").validate({
  rules: {
    first_name: "required",
    last_name: "required",
    email: {
      required: true,
      email: true,
      remote: {
        url: "verifyUser",
        type: "GET",
        data: {
          email: function () {
            return $("#email").val();
          }
        },
        complete: function (response) {
          if (response.responseText === "exists") {
            $("#error-message").text("User exists");
          } else {
            $("#error-message").text("");
          }
        }
      }
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

jQuery.validator.addMethod(
  "strongPassword",
  function (value) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/.test(
      value
    );
  },
  "Password must contain at least 8 characters including at least one lowercase letter, one uppercase letter, one digit, and one special character."
);

setTimeout(function () {
  $("#error, #message").hide("slow");
}, 5000);

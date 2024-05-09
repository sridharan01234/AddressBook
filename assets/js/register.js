$("#register-form").validate(
  {
    rules: {
      first_name: "required",
      last_name: "required",
      email: "required",
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
  },
  {
    messages: {
      first_name: "This field is required",
      last_name: "This field is required",
      email: {
        required: true,
        email: true,
      },
      password: {
        required: "this field is required",
        minlength: "minimum 8 characters required",
      },
      repeat_password: {
        required: "this field is required",
        minlength: "minimum 8 characters required",
        equalTo: "password does not match",
      },
    },
  }
);

jQuery.validator.addMethod(
  "strongPassword",
  function (value, element) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/.test(
      value
    );
  },
  "Password must contain at least 8 characters including at least one lowercase letter, one uppercase letter, one digit, and one special character."
);

$(document).ready(function () {
  $("#error").fadeOut(5000);
  $("#message").fadeOut(5000);
});

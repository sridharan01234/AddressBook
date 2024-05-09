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
    var hasLowercase = /[a-z]/.test(value);
    var hasUppercase = /[A-Z]/.test(value);
    var hasDigit = /\d/.test(value);
    var hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(value);

    return (
      this.optional(element) ||
      (hasLowercase &&
        hasUppercase &&
        hasDigit &&
        hasSpecial &&
        value.length >= 8)
    );
  },
  "Password must contain at least 8 characters including at least one lowercase letter, one uppercase letter, one digit, and one special character."
);

$(document).ready(function () {
  $("#error").slideUp(3000);
  $("#message").slideUp(3000);
});

$("#login-form").validate({
  rules: {
    email: "required",
    password: "required",
  },
  messages: {
    email: "This field is required",
    password: "This field is required",
  },
});

setTimeout(function () {
  $("#error, #message").hide("slow");
}, 5000);
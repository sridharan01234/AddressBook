$("#login-form").validate({
  rules: {
    email: "required",
    password: "required",
  },
  message: {
    email: {
      required: true,
      email: true,
    },
    password: "This field is required",
  },
});

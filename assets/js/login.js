$("#login-form").validate(
    {
      rules: {
        email: "required",
        password: {
          required: true,
        },
      },
    },
    {
      messages: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: "this field is required",
        },
      },
    }
  );
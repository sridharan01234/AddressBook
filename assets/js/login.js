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

  function togglePass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
$("#register-form").validate(
  {
    rules:
    {
      first_name : "required",
      last_name : "required",
      email: "required",
      password: {
        required: true,
        minlength: 8
      },
      repeat_password : {
        required: true,
        minlength: 8,
        equalTo: "#password"
      }
    }
  },
  {
    messages:
    {
      first_name: "This field is required",
      last_name: "This field is required",
      email:
      {
        required: true,
        email: true
      },
      password:
      {
        required: "this field is required",
        minlength: "minimum 8 characters required"
      },
      repeat_password:
      {
        required: "this field is required",
        minlength: "minimum 8 characters required",
        equalTo: "password does not match"
      }
    }
  }
);
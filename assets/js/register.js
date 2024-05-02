$("#register-form").validate(
  {
    rules:
    {
      floating_first_name : "required",
      floating_last_name : "required",
      floating_email: "required",
      floating_password: {
        required: true,
        minlength: 8
      },
      floating_repeat_password : {
        required: true,
        minlength: 8,
        equalTo: "#floating_password"
      }
    }
  },
  {
    messages:
    {
      floating_first_name: "This field is required",
      floating_last_name: "This field is required",
      floating_email:
      {
        required: true,
        email: true
      },
      floating_password:
      {
        required: "this field is required",
        minlength: "minimum 8 characters required"
      },
      floating_repeat_password:
      {
        required: "this field is required",
        minlength: "minimum 8 characters required",
        equalTo: "password does not match"
      }
    }
  }
);
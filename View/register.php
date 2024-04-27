<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="../Assets/css/register.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../Assets/css/regsiter.css" />
  </head>
  <body>
    <div class="container">
      <form class="row" name = "register" onsubmit="return validateRegisterForm()" action="" method="post">
      <div class="row justify-content-md-center">
          <div class="col-md-auto">
            <h1>Sign Up</h1>
          </div>
        </div>
      <input type="hidden" name="type" value="register">
        <div class="col-md-6">
          <label for="inputFirstName" class="form-label">First Name</label>
          <input type="text" class="form-control" name ="first_name" id="inputFirstName" />
        </div>
        <div class="col-md-6">
          <label for="inputLastName" class="form-label">Last Name</label>
          <input type="text" name="last_name" class="form-control" id="inputLastName" />
        </div>
        <div class="col-12">
          <label for="inputEmail" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="inputEmail"
            name="email"
            placeholder="Enter Your Email"
          />
        </div>
        <div class="col-12">
          <label for="inputPassword" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="inputPassword"
            name="password"
            placeholder="Create New Password"
          />
        </div>
        <div class="col-12">
          <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="inputConfirmPassword"
            placeholder="Re-enter Password"
          />
        </div>
        <p>If you Already Have an Account<a class="register-redirect" href="javascript:{}" onclick="document.getElementById('register-page').submit();"> Click here</a></p>
        <div class="col-12 justify-content-md-center">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </form>
    </div>
    <form class="login-page" id="login-page" action="../Controller/LoginController.php" method="get">
      <input type="hidden" name="type" value="index" />
    </form>
    <script src="../Assets/javascript/script.js"></script>
  </body>
</html>

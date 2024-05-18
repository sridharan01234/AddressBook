<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./assets/css/register.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>

<body>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        Address Book
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Create and account
          </h1>
          <form class="space-y-4 md:space-y-6" action="/register" id="register-form" method="post">
            <div id="error" class="p-4 mb-4 <?php if (isset($data['message'])) {
              echo " block";
            } else {
              echo "hidden";
            } ?>
                            text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800
                            dark:text-green-400" role="alert">
              <span class="font-medium">Success !</span>
              <?php if (isset($data['message']))
                echo $data['message'] ?>
              </div>
              <div id="message" class="p-4 mb-4 <?php if (isset($data['error'])) {
                echo "block";
              } else {
                echo "hidden";
              } ?>
                            text-sm text-red-800 rounded-lg bg-red-50
                            dark:bg-gray-800 dark:text-red-400" role="alert">
              <span class="font-medium">Oops!</span>
              <?php if (isset($data['error']))
                echo $data['error'] ?>
              </div>
              <input type="hidden" name="type" value="register" />
              <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="first_name" id="first_name"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                  placeholder="First Name" />
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="last_name" id="last_name"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                  placeholder="Last Name" />
              </div>

              <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="email" id="email"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                  placeholder="Email address" />
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password" id="password"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                  placeholder="Password" />
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <div class="relative z-0 w-full mb-5 group">
                  <input type="password" name="repeat_password" id="repeat_password"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40"
                    placeholder="Confirm password" />
                </div>
                <div>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">All the fields are required <span
                      class="required">*</span> </p>
                </div>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                  Already have an account yet?
                  <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="./login">
                    Click here</a>
                </p>
                <button
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Submit
                </button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script src="./assets/js/register.js"></script>
  </body>

  </html>
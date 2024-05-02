<?php
//var_dump($this->users);?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Contacts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../Assets/css/list-user.css" />
</head>

<body>

  <form action="" method="post">
    <input type="hidden" name="type" value="delete">
    <div class="flex-row items-center justify-between p-4 space-y-5 sm:flex sm:space-y-0 sm:space-x-4">
      <div>
        <h5 class="mr-3 font-semibold dark:text-white">List Users</h5>
        <p class="text-gray-500 dark:text-gray-400">
          Manage all your existing users or add a new one
        </p>
      </div>
      <div>

        <a href="../Controller/AddUserController.php">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-3.5 h-3.5 me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="add-user">
              <g>
                <path
                  d="M21 6h-1V5a1 1 0 0 0-2 0v1h-1a1 1 0 0 0 0 2h1v1a1 1 0 0 0 2 0V8h1a1 1 0 0 0 0-2zm-11 5a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0-6a2 2 0 1 1-2 2 2 2 0 0 1 2-2zm0 8a7 7 0 0 0-7 7 1 1 0 0 0 2 0 5 5 0 0 1 10 0 1 1 0 0 0 2 0 7 7 0 0 0-7-7z">
                </path>
              </g>
            </svg>
            <path
              d="M24.2,12.193,23.8,24.3a3.988,3.988,0,0,1-4,3.857H12.2a3.988,3.988,0,0,1-4-3.853L7.8,12.193a1,1,0,0,1,2-.066l.4,12.11a2,2,0,0,0,2,1.923h7.6a2,2,0,0,0,2-1.927l.4-12.106a1,1,0,0,1,2,.066Zm1.323-4.029a1,1,0,0,1-1,1H7.478a1,1,0,0,1,0-2h3.1a1.276,1.276,0,0,0,1.273-1.148,2.991,2.991,0,0,1,2.984-2.694h2.33a2.991,2.991,0,0,1,2.984,2.694,1.276,1.276,0,0,0,1.273,1.148h3.1A1,1,0,0,1,25.522,8.164Zm-11.936-1h4.828a3.3,3.3,0,0,1-.255-.944,1,1,0,0,0-.994-.9h-2.33a1,1,0,0,0-.994.9A3.3,3.3,0,0,1,13.586,7.164Zm1.007,15.151V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Zm4.814,0V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Z"
              fill="#34a853" class="color000000 svgShape"></path>
            </svg>
            Add Contact
          </button>
        </a>

        <button
        type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
            id="Delete">
            <path
              d="M24.2,12.193,23.8,24.3a3.988,3.988,0,0,1-4,3.857H12.2a3.988,3.988,0,0,1-4-3.853L7.8,12.193a1,1,0,0,1,2-.066l.4,12.11a2,2,0,0,0,2,1.923h7.6a2,2,0,0,0,2-1.927l.4-12.106a1,1,0,0,1,2,.066Zm1.323-4.029a1,1,0,0,1-1,1H7.478a1,1,0,0,1,0-2h3.1a1.276,1.276,0,0,0,1.273-1.148,2.991,2.991,0,0,1,2.984-2.694h2.33a2.991,2.991,0,0,1,2.984,2.694,1.276,1.276,0,0,0,1.273,1.148h3.1A1,1,0,0,1,25.522,8.164Zm-11.936-1h4.828a3.3,3.3,0,0,1-.255-.944,1,1,0,0,0-.994-.9h-2.33a1,1,0,0,0-.994.9A3.3,3.3,0,0,1,13.586,7.164Zm1.007,15.151V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Zm4.814,0V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Z"
              fill="#34a853" class="color000000 svgShape"></path>
          </svg>
          Delete Selected
        </button>
        <a href="../Controller/LogoutController.php">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Logout
          </button>
        </a>
      </div>
    </div>


    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="p-4">
              <div class="flex items-center">
                <input id="checkbox-all" type="checkbox"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                <label for="checkbox-all" class="sr-only">Choose</label>
              </div>
            </th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Phone</th>
            <th scope="col" class="px-6 py-3">Age</th>
            <th scope="col" class="px-6 py-3">Address</th>
            <th scope="col" class="px-6 py-3">Pincode</th>
            <th scope="col" class="px-6 py-3">Country</th>
            <th scope="col" class="px-6 py-3">State</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->users as $user): ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
              <div class="flex items-center">
                <input name="delete_users[]" value="<?php echo $user->id ?>"
                  id="flexCheckChecked<?php echo $user->id ?>" id="checkbox-table-1" type="checkbox"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                <label for="checkbox-table-1" class="sr-only">checkbox</label>
              </div>
            </td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <?php echo $user->name; ?>
            </th>
            <td class="px-6 py-4">
              <?php echo $user->phone; ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $user->age; ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $user->address; ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $user->pincode; ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $user->country ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $user->state ?>
            </td>
            <td class="px-6 py-4">
              <form id="edit-page" action="../Controller/EditUserController.php" method="get">
              <input type="hidden" name="type" value="edit">
              <input type="hidden" name="user_id" value="<?php echo $user->id?>">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="javascript:{}"
                onclick="document.getElementById('edit-page').submit();">
                view/edit</a>
              </form>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </form>
  <script src="../Assets/js/listusers.js"></script>
</body>
</html>
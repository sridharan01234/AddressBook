<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Contacts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./assets/css/listContacts.css" />
</head>

<body>
  <div class="flex-row items-center justify-between p-4 space-y-5 sm:flex sm:space-y-0 sm:space-x-4">
    <div>
      <h5 class="mr-3 font-semibold dark:text-white">List Users</h5>
      <p class="text-gray-500 dark:text-gray-400">
        Manage all your existing users or add a new one
      </p>
    </div>
    <div class="grid grid-cols-3 gap-3">

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
        <?php foreach ($data['contacts'] as $user): ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input form="delete" name="delete_users[]" value="<?php echo $user->id ?>"
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
            <form id="edit-page" action="./EditUserController.php" method="get">
              <input type="hidden" name="contact_id" value="<?php echo $user->id?>">
              <button>view/delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <script src="./assets/js/listContacts.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Contacts</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 dark:bg-gray-800">
  <div class="flex flex-col md:flex-row items-center justify-between p-4 space-y-5 md:space-y-0 md:space-x-4">
    <div>
      <h5 class="mr-3 font-semibold dark:text-white">Hi <?= $_SESSION['user_name'] ?></h5>
      <p class="text-gray-500 dark:text-gray-400">
        Manage all your existing Contacts or add a new one
      </p>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
      <form id="delete" onsubmit="return deleteAlert()" action="/deleteContact" method="post">
        <button type="submit" class="btn-delete bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg px-4 py-2">Delete Selected</button>
      </form>
      <a href="/logout">
        <button type="button" class="btn-logout bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-4 py-2">Logout</button>
      </a>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-white shadow-md dark:bg-gray-800 rounded-lg">
      <thead class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            <input id="checkbox-all" type="checkbox" onclick="checkAll(this)" class="checkbox-all" />
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
        <?php foreach ($data['contacts'] as $user) : ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">
              <input form="delete" name="delete_users[]" value="<?= $user->id ?>" id="flexCheckChecked<?= $user->id ?>" type="checkbox" class="checkbox-item" />
            </td>
            <td class="px-6 py-4"><?= $user->name ?></td>
            <td class="px-6 py-4"><?= $user->phone ?></td>
            <td class="px-6 py-4"><?= $user->age ?></td>
            <td class="px-6 py-4"><?= $user->address ?></td>
            <td class="px-6 py-4"><?= $user->pincode ?></td>
            <td class="px-6 py-4"><?= $user->country ?></td>
            <td class="px-6 py-4"><?= $user->state ?></td>
            <td class="px-6 py-4">
              <form id="edit-page" action="">
                <input type="hidden" name="contact_id" value="<?= $user->id ?>">
                <button class="btn-edit bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-4 py-2">View/Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="./assets/js/listContacts.js"></script>
</body>

</html>
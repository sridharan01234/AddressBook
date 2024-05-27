<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Contacts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./assets/css/listContacts.css">
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
        <button type="submit"
          class="btn-delete bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg px-4 py-2">Delete
          Selected</button>
      </form>
      <a href="/addContact">
        <button type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Add new Contacts
        </button>
      </a>
      <a href="/logout">
        <button type="button"
          class="btn-logout bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-4 py-2">Logout</button>
      </a>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table
      class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-white shadow-md dark:bg-gray-800 rounded-lg">
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
        <?php foreach ($data['contacts'] as $user): ?>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">
              <input form="delete" name="delete_users[]" value="<?= $user->id ?>" id="flexCheckChecked<?= $user->id ?>"
                type="checkbox" class="checkbox-item" />
            </td>
            <td class="px-6 py-4"><?= $user->name ?></td>
            <td class="px-6 py-4"><?= $user->phone ?></td>
            <td class="px-6 py-4"><?= $user->age ?></td>
            <td class="px-6 py-4"><?= $user->address ?></td>
            <td class="px-6 py-4"><?= $user->pincode ?></td>
            <td class="px-6 py-4"><?= $user->country ?></td>
            <td class="px-6 py-4"><?= $user->state ?></td>
            <td class="px-6 py-4">
              <button class="bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-4 py-2">
                <a href="#" class="view-btn" data-id="<?= $user->id ?>">View</a> </button>
              <button class="bg-red-700 hover:bg-red-800 text-white font-medium rounded-lg px-4 py-2"">
              <a href=" /editContact?id=<?= $user->id ?>">Edit</a>
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="overlay">
    <div class="modal">
      <div class="modal-content">
        <span id="contact-info"></span>
        <button id="close-btn">Close</button>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="./assets/js/listContacts.js"></script>
  <script>

    $('.view-btn').click(function () {
      let id = $(this).data('id');

      $.ajax({
        type: 'GET',
        url: '/getContact',
        data: { id: id }
      })
        .done(function (contact) {
          contact = JSON.parse(contact);
          console.log(contact);
          let formattedContact = `
          <strong>Name:</strong> ${contact.name}<br>
          <strong>Phone:</strong> ${contact.phone}<br>
          <strong>Age:</strong> ${contact.age}<br>
          <strong>Pincode:</strong> ${contact.pincode}<br>
          <strong>Address:</strong> ${contact.address}<br>
          <strong>Country:</strong> ${contact.country}<br>
          <strong>State:</strong> ${contact.state}<br>
          <strong>Created At:</strong> ${contact.created_at}<br>
          <strong>Updated At:</strong> ${contact.updated_at}<br>
        `;

          $('#contact-info').html(formattedContact);
          $('.overlay').show();
        })
        .fail(function () {
          $('#contact-info').html("Failed to retrieve contact information.");
          $('.overlay').show();
        });
    });

    $('#close-btn').click(function () {
      $('.overlay').hide();
    });

    $('#close-btn').click(function () {
      $('.overlay').hide();
    });
  </script>
</body>

</html>
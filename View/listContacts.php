<?php
//var_dump($this->users);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Contacts</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../Assets/css/list-user.css" />
  </head>
  <body>
    <h1>List of Contacts</h1>
    <div class="container">
    <form action="" method="post">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Age</th>
            <th scope="col">Address</th>
            <th scope="col">Pincode</th>
            <th scope="col">Country</th>
            <th scope="col">State</th>
            <th scope="col">View/Edit</th>
            <th scope="col">Choose</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($this->users as $user): ?>
          <tr>
            <th scope="row"><?php echo $user->id; ?></th>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->phone; ?></td>
            <td><?php echo $user->age; ?></td>
            <td><?php echo $user->address; ?></td>
            <td><?php echo $user->pincode; ?></td>
            <td><?php echo $user->country ?></td>
            <td><?php echo $user->state ?></td>
            <td><a href="">ClickHere</a></td>
            <td>
            <div class="form-check">
              <form action="../Controller/delete.php" method="post">
              <input
              class="form-check-input"
               type="checkbox"
               name="delete_users[]"
               value="<?php echo $user->id ?>"
               id="flexCheckChecked<?php echo $user->id ?>"
              />
            </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button>Submit</button>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

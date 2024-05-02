<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
    <section class="bg-white dark:bg-gray-900">
      <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
          Update product
        </h2>
        <form action="" method="post">
          <input type="hidden" name="id" value="<?php $id?>">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="w-full">
              <label
                for="name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >
                Name</label
              >
              <input
                type="text"
                name="name"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                value="<?php echo $user->name?>"
                placeholder="<?php echo $user->name?>"
                required=""
              />
            </div>
            <div class="w-full">
              <label
                for="phone"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Phone</label
              >
              <input
                type="number"
                name="phone"
                id="phone"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                value="<?php echo $user->phone?>"
                placeholder="<?php echo $user->phone?>"
                required=""
              />
            </div>
            <div class="w-full">
              <label
                for="age"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Age</label
              >
              <input
                type="number"
                name="age"
                id="age"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                value="<?php echo $user->age?>"
                placeholder="<?php echo $user->age?>"
                required=""
              />
            </div>
            <div class="w-full">
              <label
                for="pincode"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Pincode</label
              >
              <input
                type="number"
                name="pincode"
                id="pincode"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                value="<?php echo $user->pincode?>"
                placeholder="<?php echo $user->pincode?>"
                required=""
              />
            </div>
            <div>
              <label
                for="country"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Country</label
              >
              <select
              name="country"
                id="countrySelect"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              >
                <option selected="">Select ...</option>
              </select>
            </div>
            <div>
              <label
                for="state"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >State</label
              >
              <select
                id="stateSelect"
                name="state"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              >
                <option selected="">Select ...</option>
              </select>
            </div>
            <div class="sm:col-span-2">
              <label
                for="address"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Address</label
              >
              <textarea
                id="address"
                rows="8"
                name="address"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Write you Address here..."
              >
<?php echo $user->address?>
              </textarea>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <button
              type="submit"
              class="text-blue-600 inline-flex items-center hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900"
            >
              Update
            </button>
            <button
              type="button"
              class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"
            >
              <svg
                class="w-5 h-5 mr-1 -ml-1"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Delete
            </button>
          </div>
        </form>
      </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../Assets/js/fetchCountriesAndStates.js"></script>
  </body>
</html>

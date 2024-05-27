<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add user</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/addcontacts.css">
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                Add a new Contact
            </h2>
            <div id="error" class="p-4 mb-4 <?php echo (isset($data['message']) ? DisplayState::BLOCK : DisplayState::HIDDEN)->value; ?>
                            text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800
                            dark:text-green-400" role="alert">
                <span class="font-medium">Success !</span>
                <?php if (isset($data['message'])) {
                    echo $data['message'];
                }
                ?>
            </div>
            <div id="message" class="p-4 mb-4 <?php echo (isset($data['error']) ? DisplayState::BLOCK : DisplayState::HIDDEN)->value; ?>
                            text-sm text-red-800 rounded-lg bg-red-50
                            dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Oops!</span>
                <?php if (isset($data['error'])) {
                    echo $data['error'];
                }
                ?>
            </div>
            <form id="contact-form" action="/addContact" method="post">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                            name
                        </label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Contact name" />
                    </div>
                    <div class="w-full">
                        <label for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Contact Number" />

                        <div id="error-message" class="text-red-500"></div>
                    </div>
                    <div>
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                            Birth</label>
                        <input type="date" id="dob"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="<?php echo $contact->age ?>" />
                        <input type="hidden" name="age" id="age">
                    </div>
                    <div>
                        <label for="pincode"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pincode
                        </label>
                        <input type="number" name="pincode" id="pincode"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Your Pincode" />
                    </div>

                    <div>
                        <label for="countrySelect"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <select id="countrySelect" name="country"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select country..</option>
                        </select>
                    </div>
                    <div>
                        <label for="state"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                        <select id="stateSelect" name="state"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Select state..</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            message</label>
                        <textarea id="address" rows="4" name="address"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your address here..."></textarea>
                    </div>
                </div>
                <div class="buttons">
                    <div class="md:container md:mx-auto">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add Contact
                        </button>
                        <a href="/listContacts">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Go Back
                            </button>
                        </a>
                    </div>
                </div>
        </div>
        </a>
        </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="./assets/js/fetchCountriesAndStates.js"></script>
    <script src="./assets/js/validContacts.js"></script>
    <script>
        let dobInput = document.getElementById('dob');
        dobInput.addEventListener('change', calculateAge);
        function calculateAge() {
            let dob = dobInput.value;
            let dobParts = dob.split('-');
            let birthDate = new Date(dobParts[0], dobParts[1] - 1, dobParts[2]);
            let currentDate = new Date();
            let age = currentDate.getFullYear() - birthDate.getFullYear();
            document.getElementById('age').value = age;
        }
    </script>
</body>

</html>
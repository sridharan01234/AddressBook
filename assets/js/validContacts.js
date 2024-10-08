$("#contact-form").validate({
    rules: {
        name: "required",
        phone: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10,
        },
        address: "required",
        state: "required",
        pincode: "required",
        country: "required",
        age: {
            required: true,
            number: true,
            min: 1,
            max: 100,
        },
    },
    messages: {
        name: "Please enter your name",
        phone: {
            required: "Please enter your phone number",
            number: "Phone number should be a number",
            minlength: "Phone number should be 10 digits",
            maxlength: "Phone number should be 10 digits",
        },
        address: "Please enter your address",
        state: "Please enter your state",
        pincode: "Please enter your pincode",
        country: "Please enter your country",
        age: {
            required: "Please enter your age",
            number: "Please enter a valid number",
            max: "You can't be older than 100 years old",
            min: "You can't be younger than 1 year old",
        },

    },
});

setTimeout(function () {
    $("#error, #message").hide("slow");
}, 5000);

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
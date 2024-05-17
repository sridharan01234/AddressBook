$("#add-contact-form").validate({
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
            number: "Please enter a valid phone number",
            minlength: "Please enter a valid phone number",
            maxlength: "Please enter a valid phone number",
            maxlength: "Please enter a valid phone number",
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

var phoneInput = document.getElementById("phone");
var errorMessage = document.getElementById("error-message");
var form = document.getElementById("add-contact-form");

phoneInput.addEventListener("input", function () {
    var phone = phoneInput.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/checkContact?phone=" + phone, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var contactExists = response.exists;

            if (contactExists) {
                errorMessage.textContent = "Contact already exists";
                form.addEventListener("submit", preventFormSubmission);
            } else {
                errorMessage.textContent = "";
                form.removeEventListener("submit", preventFormSubmission);
            }
        }
    };
    xhr.send();
});

function preventFormSubmission(event) {
    event.preventDefault();
}

setTimeout(function () {
    $("#error, #message").hide("slow");
}, 5000);
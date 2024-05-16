$("#edit-contact-form").validate({
    rules: {
        name: "required",
        phone: {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true,
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
            minlength: "Please enter a valid phone number",
            maxlength: "Please enter a valid phone number",
            digits: "Please enter a valid phone number",
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
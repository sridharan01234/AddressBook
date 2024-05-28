window.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.getElementsByName('delete_users[]');
    const checkboxAll = document.getElementById('checkbox-all');

    function selectAll() {
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkboxAll.checked;
        }
    }

    checkboxAll.addEventListener('change', selectAll);
});

function deleteAlert() {
    return confirm("Are you sure you want to delete this user?");
}


$('.view-btn').click(function () {
    console.log("check");
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
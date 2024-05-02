$(document).ready(function(){
    $.ajax({
        url: '../Ajax/fetchCountries.php',
        type: 'GET',
        success: function(response) {
            var countries = JSON.parse(response);
            populateCountries(countries);
        },
        error: function(xhr, status, error) {
            console.error("Error fetching countries: " + error);
        }
    });

    function populateCountries(countries) {
        var select = $('#countrySelect');
        $.each(countries, function(index, country) {
            select.append('<option value="' + country.id + '">' + country.name + '</option>');
        });
        
        select.change(function() {
            var countryId = $(this).val();
            fetchStates(countryId);
        });
    }

    function fetchStates(countryId) {
        $.ajax({
            url: '../Ajax/fetchStates.php',
            type: 'GET',
            data: { country_id: countryId },
            success: function(response) {
                var states = JSON.parse(response);
                populateStates(states);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching states: " + error);
            }
        });
    }

    function populateStates(states) {
        var select = $('#stateSelect');
        select.empty();
        $.each(states, function(index, state) {
            select.append('<option value="' + state.id + '">' + state.name + '</option>');
        });
    }
});

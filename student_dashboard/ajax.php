<script>
    $(document).ready(() => {
        function updateCityDropdown(data) {
            var cities = data.cities;

            $(".country_code").each(function() {
                $(this).val(data.country_code);
            });

            $('#city').empty().append('<option value="">select options</option>');

            cities.forEach(element => {
                var selected = element.city_name === 'Hyderabad' ? 'selected' : '';
                $('#city').append(`<option value="${element.id}" ${selected}>${element.city_name}</option>`);
            });
        }

        function fetchCities(selectedValue) {
            $.ajax({
                url: 'all_city.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: selectedValue
                },
                success: updateCityDropdown,
                error: function() {
                    console.log('error');
                }
            });
        }

        // Initial load with a default value of 1
        fetchCities(<?php echo $session_std_country; ?>);

        $('#country').on('change', function() {
            var selectedValue = $(this).val();
            fetchCities(selectedValue);
        });
    });
</script>
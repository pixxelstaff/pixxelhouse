
      // Function to store and restore selected options in local storage
      function storeSelectedOptions() {
         var selectedOptions = {};
         $('input[type="radio"]:checked').each(function() {
            selectedOptions[$(this).attr('name')] = $(this).val();
         });
         localStorage.setItem('selectedOptions', JSON.stringify(selectedOptions));
      }

      function restoreSelectedOptions() {
         var selectedOptions = JSON.parse(localStorage.getItem('selectedOptions'));
         if (selectedOptions) {
            $.each(selectedOptions, function(name, value) {
               $('input[type="radio"][name="' + name + '"][value="' + value + '"]').prop('checked', true);
            });
         }
      }

      // Call the functions to store and restore selected options
      $(document).ready(function() {
         restoreSelectedOptions();
         $('input[type="radio"]').change(storeSelectedOptions);
      });


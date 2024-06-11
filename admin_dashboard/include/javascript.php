<script src="../assets/js/notify.js"></script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <!--<script src="../assets/js/dashboard.js"></script>-->


  <script>
        function type_email() {
            var email = document.getElementById('teacher_email');
            var portal_email = document.getElementById('portal_email');
            portal_email.value = email.value;
        }

        $(document).ready(function() {
            $("#toggleButton").click(function(event) {
                event.preventDefault(); // Prevent default button behavior

                var passwordInput = $("#portal_password");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    $("#eyeIcon").removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    passwordInput.attr("type", "password");
                    $("#eyeIcon").removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>

<script>
          function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td")[1];
              if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  tr[i].style.display = "none";
                }
              }
            }
          }
        </script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("multisteps_form_panel");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  var next_btn = document.getElementById("nextBtn");
  var sub_btn = document.getElementById("sub_btn");
  if (n == x.length - 1) {
    next_btn.style.display = "none";
    sub_btn.style.display = "block";
  } else {
    next_btn.style.display = "block";
    sub_btn.style.display = "none";
  }
}

function nextPrev(n) {
  var x = document.getElementsByClassName("multisteps_form_panel");
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  showTab(currentTab);
}

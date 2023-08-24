require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all.min.js'); 
$("input[id='lightSwitch']").on("change", function() {
    if ($("html").attr("data-bs-theme") == 'light') {
      $("html").attr("data-bs-theme", "dark");
    } else if ($("html").attr("data-bs-theme") == "dark") {
      $("html").attr("data-bs-theme", "light");
    }
  });
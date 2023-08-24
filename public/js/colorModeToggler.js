$("input[id='lightSwitch']").on("change", function() {
  if ($("html").attr("data-bs-theme") == 'light') {
    $("html").attr("data-bs-theme", "dark");
  } else if ($("html").attr("data-bs-theme") == "dark") {
    $("html").attr("data-bs-theme", "light");
  }
});
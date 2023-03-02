$(document).ready(function() {
  // Load the list of files when the page loads
  $.post("ajax.php", { action: "get" }, function(data) {
    $("#filename_select").html(data);
  });

  // Load the selected file when the user clicks the "Load File" button
  $("#load_button").click(function() {
    var filename = $("#filename_select").val();
    if (filename) {
      $.post("ajax.php", { action: "load", filename: filename }, function(data) {
        $("#note").val(data);
      });
    }
  });

  // Prompt the user for a file name and save the file when the user clicks the "Save File As" button
  $("#save_button").click(function() {
    var filename = prompt("Enter a file name:", "");
    if (filename) {
      $.post("ajax.php", { action: "save", filename: filename, content: $("#note").val() }, function(data) {
        alert("File saved.");
      });
    }
  });
});
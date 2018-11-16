//If enter is pressed
$.ajaxSetup({
  cache: false
});

function signOut() {
  console.log("sign out pressed");
  var name = $('input#name').val();
  if ($.trim(name) != '') {
    $.post('confirmSignOut.php', {
      name: name
    }, function(data) {
      $('div#name-data').text(data);
      document.getElementsByName('name')[0].value = "";
      var today = getCurrentDate();
      $.post('spreadsheetIsCurrent.php', {}, function(isCurrent) {
        if (isCurrent == "false") {
          //creates new spreadsheets, loads new student file, writes today's date into date.txt
          $.post("quickstart.php", {}, function(spreadsheetID) {
            setUpSheets(spreadsheetID, false);
            $('#response').html('<p>New spreadsheet has just been created.</p>');
          });
        } else {
          $.post("retrieveSID.php", {}, function(spreadsheetID) {
            addRecord(spreadsheetID, false);
            $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
          });
        }
        setTimeout(function() {
          document.getElementById("name").focus();
        }, 1);
      });
    });
  }
}
function signOut() {
  $.ajaxSetup({
    cache: false
  });
  var name = $('input#name').val();
  if ($.trim(name) != '') {
    $.post('spreadsheetIsCurrent.php', {}, function(isCurrent) {
      $.post('confirmSignOut.php', {
        name: name
      }, function(data) {
        var parsedData = JSON.parse(data);
        var today = getCurrentDate();
        if (isCurrent == "false") {
          //creates new spreadsheets, loads new student file, writes today's date into date.txt
          $.post("quickstart.php", {}, function(spreadsheetID) {
            setUpSheets(spreadsheetID, false, parsedData[1]);
            $('#response').html('<p>New spreadsheet has just been created.</p>');
          });
        } else {
          $.post("retrieveSID.php", {}, function(spreadsheetID) {
            addRecord(spreadsheetID, false, parsedData[1]);
            $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
          });
        }
        $('div#name-data').text(parsedData[0]);
        document.getElementsByName('name')[0].value = "";
        if (parsedData[2]) {
          var myWindow = window.open("", "Sign-out Slip");
          myWindow.document.write(parsedData[3]);
          myWindow.print();
          myWindow.close();
        }
        setTimeout(function() {
          document.getElementById("name").focus();
        }, 1);
      });
    });
  }
}
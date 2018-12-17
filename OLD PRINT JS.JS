function signIn() {
  $.ajaxSetup({
    cache: false
  });
  var name = $('input#name').val();
  if ($.trim(name) != '') {
    $.post('print.php', {
      name: name
    }, function(data) {
      $.post('spreadsheetIsCurrent.php', {}, function(isCurrent) {
        if (isCurrent == "false") {
          $.post("quickstart.php", {}, function(spreadsheetID) {
            setUpSheets(spreadsheetID, true);
            $('#response').html('<p>New spreadsheet has just been created.</p>');
          });
        } else {
          $.post("retrieveSID.php", {}, function(spreadsheetID) {
            addRecord(spreadsheetID, true);
            $('#response').html('<p>Spreadsheet was last updated on ' + getCurrentDate() + '.</p>');
          });
        }
      });
      //prints slip
      var parsedData = JSON.parse(data)
      $('div#name-data').text(parsedData[0]);
      document.getElementsByName('name')[0].value = "";
      var myWindow = window.open("", "Tardy Slip");
      myWindow.document.write(parsedData[1]);
      myWindow.print();
      myWindow.close();
      setTimeout(function() {
        document.getElementById("name").focus();
      }, 1);
    });
  }
}
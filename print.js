//If enter is pressed
$.ajaxSetup({
  cache: false
});

function signIn() {
  var name = $('input#name').val();
  if ($.trim(name) != '') {
    var today = getCurrentDate();
    $.post('spreadsheetIsCurrent.php', {}, function(isCurrent) {
      if (isCurrent == "false") {
        //creates new spreadsheets, loads new student file, writes today's date into date.txt
        $.post("quickstart.php", {}, function(spreadsheetID) {
          setUpSheets(spreadsheetID, true);
          $('#response').html('<p>New spreadsheet has just been created.</p>');
        });
      } else {
        $.post("retrieveSID.php", {}, function(spreadsheetID) {
          addRecord(spreadsheetID, true);
          $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
        });
      }
      $.post('print.php', {
        name: name
      }, function(data) {
        var parsedData = JSON.parse(data)
        $('div#name-data').text(parsedData[0]);
        document.getElementsByName('name')[0].value = "";
        //prints slip
        var myWindow = window.open("", "Tardy Slip");
        myWindow.document.write(parsedData[1]);
        myWindow.print();
        myWindow.close();
        setTimeout(function() {
          document.getElementById("name").focus();
        }, 1);
      });
    });
  }
}
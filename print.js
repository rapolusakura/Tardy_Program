//If enter is pressed
$.ajaxSetup({
  cache: false
});
document.getElementById('name').onkeydown = function(event) {
  if (event.keyCode == 13) {
    var name = $('input#name').val();
    if ($.trim(name) != '') {
      $.post('print.php', {
        name: name
      }, function(data) {
        $('div#name-data').text(data);
        document.getElementsByName('name')[0].value = "";
        var today = getCurrentDate();
        $.get('date.txt', function(date) {
          //checks if today's date is the same as the date written into the text file
          if (today != date) {
            //creates new spreadsheets, loads new student file, writes today's date into date.txt
            $.post("quickstart.php", {
              name: name
            }, function(spreadsheetID) {
              setUpSheets(spreadsheetID, true);
              $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
            });
          } else {
            $.post("retrieveSID.php", {}, function(spreadsheetID) {
              addRecord(spreadsheetID, true);
              $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
            });
            // $.get('SpreadsheetID.txt', function(sid) {
            //   addRecord(sid, true); // Enter your Google Sheet ID here - only field that changes daily
            // }, 'text');
          }
        });
        //prints textfile
        var text_to_print = open('DVHS_Tardy_Registration.txt');
        text_to_print.onload = function() {

          text_to_print.print();
          setTimeout(function() {
            text_to_print.close();
          }, 1);
        };
        setTimeout(function() {
          document.getElementsByName('name').focus();
        }, 1);
      });
    }
  }
};
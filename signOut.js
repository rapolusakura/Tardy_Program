//If enter is pressed
document.getElementById('name').onkeydown = function(event) {
  if (event.keyCode == 13) {
    var name = $('input#name').val();
    if ($.trim(name) != '') {
      $.post('confirmSignOut.php', {
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
              setUpSheets(spreadsheetID, false);
              //addRecord(spreadsheetID);
              $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
            });
          } else {
            $.get('SpreadsheetID.txt', function(sid) {
              addRecord(sid, false); // Enter your Google Sheet ID here - only field that changes daily
            }, 'text');
          }
        });
        //prints textfile
        setTimeout(function() {
          document.getElementsByName('name').focus();
        }, 1);
      });
    }
  }
};

function getCurrentDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }
  today = mm + '-' + dd + '-' + yyyy;
  return today;
}
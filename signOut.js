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
            console.log(sid)
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
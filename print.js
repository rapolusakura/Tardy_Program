//If enter is pressed
$.ajaxSetup({
  cache: false
});
document.getElementById('name').onkeydown = function(event) {
  if (event.keyCode == 13) {
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
          $('div#name-data').text(data);
          document.getElementsByName('name')[0].value = "";
          //prints slip
          var txt = "<?php echo $txt?>";
          var myWindow = window.open("", "Tardy Slip", "width=200,height=100");
          myWindow.document.write(txt);
          myWindow.print();
          myWindow.close();

          setTimeout(function() {
            document.getElementsByName('name').focus();
          }, 1);
        });
      });
    }
  }
};
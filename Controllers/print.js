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
              setUpSheets(spreadsheetID);
              //when you get this callback, call the setUpSheets method and then in that call back, add the record.
              //addRecord(spreadsheetID);
              $('#response').html('<p>Spreadsheet was last updated on ' + today + '.</p>');
            });
          } else {
            $.get('SpreadsheetID.txt', function(sid) {
              addRecord(sid); // Enter your Google Sheet ID here - only field that changes daily
            }, 'text');
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

function setUpSheets(sid) {
  async: false;
  var gs_sid = sid
  var gs_clid = service.gs_clid; // Enter your API Client ID here
  var gs_clis = service.gs_clis; // Enter your API Client Secret here
  var gs_rtok = service.gs_rtok; // Enter your OAuth Refresh Token here
  var gs_atok = false;
  var gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + ':batchUpdate';
  var gs_body = '{"requests":[{"addSheet":{"properties":{"title":"SIGN-OUT"}}},{"addSheet":{"properties":{"title":"SIGN-IN"}}},{"deleteSheet":{"sheetId":0}}]}';
  // HTTP Request Token Refresh
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'https://www.googleapis.com/oauth2/v4/token?client_id=' + gs_clid + '&client_secret=' + gs_clis + '&refresh_token=' + gs_rtok + '&grant_type=refresh_token');
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    var response = JSON.parse(xhr.responseText);
    var gs_atok = response.access_token;
    // HTTP Request Append Data
    if (gs_atok) {
      var xxhr = new XMLHttpRequest();
      xxhr.open('POST', gs_url);
      xxhr.setRequestHeader('Content-length', gs_body.length);
      xxhr.setRequestHeader('Content-type', 'application/json');
      xxhr.setRequestHeader('Authorization', 'OAuth ' + gs_atok);
      xxhr.onload = function() {
        if (xxhr.status == 200) {
          // Success
          //$('#message').html('<p>Row Added!</p>');
        } else {
          // Fail
          $('#message').html('<p>Sheet Not Added</p><p>Response:<br/>' + xxhr.responseText + '</p>');
        }
      };
      xxhr.send(gs_body);
    }
  };
  xhr.send();
}

function addRecord(sid) {
  $.get('Sheets.txt', function(data) {
    async: false;
    var gs_sid = sid;
    var gs_clid = service.gs_clid; // Enter your API Client ID here
    var gs_clis = service.gs_clis; // Enter your API Client Secret here
    var gs_rtok = service.gs_rtok; // Enter your OAuth Refresh Token here
    var gs_atok = false;
    var gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + '/values/SIGN-IN!A1:append?includeValuesInResponse=false&insertDataOption=INSERT_ROWS&responseDateTimeRenderOption=SERIAL_NUMBER&responseValueRenderOption=FORMATTED_VALUE&valueInputOption=USER_ENTERED';
    var gs_body = '{"majorDimension":"ROWS", "values":[[' + data + ']]}';
    // HTTP Request Token Refresh
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://www.googleapis.com/oauth2/v4/token?client_id=' + gs_clid + '&client_secret=' + gs_clis + '&refresh_token=' + gs_rtok + '&grant_type=refresh_token');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      var response = JSON.parse(xhr.responseText);
      var gs_atok = response.access_token;
      // HTTP Request Append Data
      if (gs_atok) {
        var xxhr = new XMLHttpRequest();
        xxhr.open('POST', gs_url);
        xxhr.setRequestHeader('Content-length', gs_body.length);
        xxhr.setRequestHeader('Content-type', 'application/json');
        xxhr.setRequestHeader('Authorization', 'OAuth ' + gs_atok);
        xxhr.onload = function() {
          if (xxhr.status == 200) {
            // Success
            //$('#message').html('<p>Row Added!</p>');
          } else {
            // Fail
            $('#message').html('<p>Row Not Added</p><p>Response:<br/>' + xxhr.responseText + '</p>');
          }
        };
        xxhr.send(gs_body);
      }
    };
    xhr.send();
  }, 'text');
}
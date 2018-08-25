function setUpSheets(sid, isSigningIn) {
  async: false;
  var gs_sid = sid
  var gs_clid = service.gs_clid; // Enter your API Client ID here
  var gs_clis = service.gs_clis; // Enter your API Client Secret here
  var gs_rtok = service.gs_rtok; // Enter your OAuth Refresh Token here
  var gs_atok = false;
  var gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + ':batchUpdate';
  var gs_body = '{"requests":[{"addSheet":{"properties":{"title":"SIGN-IN"}}},{"addSheet":{"properties":{"title":"SIGN-OUT"}}},{"deleteSheet":{"sheetId":0}}]}';
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
          addRecord(sid, isSigningIn);
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

function addRecord(sid, isSigningIn) {
  $.get('Sheets.txt', function(data) {
    async: false;
    var gs_sid = sid;
    var gs_clid = service.gs_clid; // Enter your API Client ID here
    var gs_clis = service.gs_clis; // Enter your API Client Secret here
    var gs_rtok = service.gs_rtok; // Enter your OAuth Refresh Token here
    var gs_atok = false;
    var gs_url = ""
    if (isSigningIn) {
      gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + '/values/SIGN-IN!A1:append?includeValuesInResponse=false&insertDataOption=INSERT_ROWS&responseDateTimeRenderOption=SERIAL_NUMBER&responseValueRenderOption=FORMATTED_VALUE&valueInputOption=USER_ENTERED';
    } else {
      gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + '/values/SIGN-OUT!A1:append?includeValuesInResponse=false&insertDataOption=INSERT_ROWS&responseDateTimeRenderOption=SERIAL_NUMBER&responseValueRenderOption=FORMATTED_VALUE&valueInputOption=USER_ENTERED';
    }
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
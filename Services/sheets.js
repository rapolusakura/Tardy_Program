function setUpSheets(sid) {
  async: false;
  var gs_sid = sid
  var gs_clid = '64846370604-7gnht5k99v2qt9fbrbqsqtka294jjqod.apps.googleusercontent.com'; // Enter your API Client ID here
  var gs_clis = 'Wpjhj1zvnulizzotjtjXxILW'; // Enter your API Client Secret here
  var gs_rtok = '1/rPj6l1t7WEg0yEohQwUueJXejRwltVycHxp0_wgdIWah_7vEcj2JM0WvfVlLHFq_'; // Enter your OAuth Refresh Token here
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
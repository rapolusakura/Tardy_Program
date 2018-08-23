// document.getElementById('name').onkeydown = function(event) {
//   console.log("HI BITCH")
//   addSheet()
// };

function addSheet() {
  console.log("Hello")
  $.get('Sheets.txt', function(data) {
    async: false;
    var gs_sid = '1_AwVDOGqwkBMoANa_Z28dJI0woANSuLgZb13bx5ynfE';
    var gs_clid = '64846370604-7gnht5k99v2qt9fbrbqsqtka294jjqod.apps.googleusercontent.com'; // Enter your API Client ID here
    var gs_clis = 'Wpjhj1zvnulizzotjtjXxILW'; // Enter your API Client Secret here
    var gs_rtok = '1/rPj6l1t7WEg0yEohQwUueJXejRwltVycHxp0_wgdIWah_7vEcj2JM0WvfVlLHFq_'; // Enter your OAuth Refresh Token here
    var gs_atok = false;
    //https://sheets.googleapis.com/v4/spreadsheets/1_AwVDOGqwkBMoANa_Z28dJI0woANSuLgZb13bx5ynfE:batchUpdate
    var gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/' + gs_sid + ':batchUpdate';
    var gs_body = '{"requests":[{"addSheet":{"properties":{"title":"' + new Date() + '"}}}]}';
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
<!DOCTYPE html>
<html>
  <head></head>
  <body>
    <!--
    BEFORE RUNNING:
    1. If not already done, enable the Google Sheets API
       and check the quota for your project at
       https://console.developers.google.com/apis/api/sheets
    2. Get access keys for your application. See
       https://developers.google.com/api-client-library/javascript/start/start-js#get-access-keys-for-your-application
    3. For additional information on authentication, see
       https://developers.google.com/sheets/api/quickstart/js#step_2_set_up_the_sample
    -->
    <script>
    function makeApiCall() {
      var params = {
        // The spreadsheet to apply the updates to.
        spreadsheetId: '1_AwVDOGqwkBMoANa_Z28dJI0woANSuLgZb13bx5ynfE',  // TODO: Update placeholder value.
      };

      var batchUpdateSpreadsheetRequestBody = {
        // A list of updates to apply to the spreadsheet.
        // Requests will be applied in the order they are specified.
        // If any request is not valid, no requests will be applied.
        requests: [{
      "addSheet": {
        "properties": {
          "title": "ahahha BITCH",
          "gridProperties": {
            "rowCount": 20,
            "columnCount": 12
          },
          "tabColor": {
            "red": 1.0,
            "green": 0.3,
            "blue": 0.4
          }
        }
      }
    }],  // TODO: Update placeholder value.

        // TODO: Add desired properties to the request body.
      };

      var request = gapi.client.sheets.spreadsheets.batchUpdate(params, batchUpdateSpreadsheetRequestBody);
      request.then(function(response) {
        // TODO: Change code below to process the `response` object:
        console.log(response.result);
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
    }

    function initClient() {
      var API_KEY = 'AIzaSyDP_vdpdBSqJobAnUOJTz-hlYKlHKQwDYw';  // TODO: Update placeholder with desired API key.

      var CLIENT_ID = '64846370604-7gnht5k99v2qt9fbrbqsqtka294jjqod.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.

      // TODO: Authorize using one of the following scopes:
      //   'https://www.googleapis.com/auth/drive'
      //   'https://www.googleapis.com/auth/drive.file'
      //   'https://www.googleapis.com/auth/spreadsheets'
      var SCOPE = 'Drive';

      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    function updateSignInStatus(isSignedIn) {
      if (isSignedIn) {
        makeApiCall();
      }
    }

    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <button id="signin-button" onclick="handleSignInClick()">Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>
  </body>
</html>

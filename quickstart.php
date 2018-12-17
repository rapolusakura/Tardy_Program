<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'connect.php';
date_default_timezone_set('America/Los_Angeles');

define('APPLICATION_NAME', 'Drive API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/drive-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');

// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/drive-php-quickstart.json
define('SCOPES', implode(' ', array(
  Google_Service_Drive::DRIVE_FILE)
));

// Get the API client and construct the service object.
$client = getClient();
$driveService = new Google_Service_Drive($client);

// Creates the spreadsheet into the TeamDrive folder
$folderId = getFolderId();
$fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => date("m-d-Y"),
    'mimeType' => 'application/vnd.google-apps.spreadsheet',
    'parents' => array($folderId)
));
$file = $driveService->files->create($fileMetadata, array(
    'uploadType' => 'resumable',
    'fields' => 'id'));
printf($file->id);

$result = $conn->query("
  UPDATE `info`
  SET `info`.`spreadsheet-id` = '" . $file->id."'
  WHERE `info`.`school-id` = '" . $_COOKIE["school_id"]."'
");

// Imports the data from the student table

// $conn->query("LOAD DATA LOCAL INFILE 'extract(2).csv' INTO TABLE student IGNORE 1 LINES (id, first_name, last_name, grade);");
mysqli_close($conn);

//helper functions

function getFolderId() {
  if ($_COOKIE["school_id"] == "Dougherty Valley High School") {
    return '1VEyfadhJKkM-XGWZypIHnVs9AlmjDsFI';
  }
  elseif ($_COOKIE["school_id"] == "Monte Vista High School") {
    return '135M7iSGvegDkjI_OEY97da09BwnZ-Rjg';
  }
  elseif ($_COOKIE["school_id"] == "San Ramon Valley High School") {
    return '1Ak7YhtrtjpMFLG7Vszy5PuUo4ZA1ddcc';
  }
  elseif ($_COOKIE["school_id"] == "California High School") {
    return '1yprflwp_pX9Ix1eHwE3u3sRR3K8nIzb-';
  }
}

function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig(CLIENT_SECRET_PATH);
  $client->setAccessType('offline');

  // Load previously authorized credentials from a file.
  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {
    $accessToken = json_decode(file_get_contents($credentialsPath), true);
  } else {
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    printf("Open the following link in your browser:\n%s\n", $authUrl);
    print 'Enter verification code: ';
    $authCode = trim(fgets(STDIN));

    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, json_encode($accessToken));
    printf("Credentials saved to %s\n", $credentialsPath);
  }
  $client->setAccessToken($accessToken);

  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
  }
  return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if (empty($homeDirectory)) {
    $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

?>

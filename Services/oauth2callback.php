<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfigFile('client_secrets.json');
$client->setRedirectUri('http://localhost/Tardy_Program/oauth2callback.php');
$client->addScope(Google_Service_Drive::DRIVE);

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

$service = new Google_Service_Drive($client);

// Print the names and IDs for up to 10 files.
$optParams = array(
  'pageSize' => 10,
  'fields' => 'nextPageToken, files(id, name)'
);
$results = $service->files->listFiles($optParams);

// $fileMetadata = new Google_Service_Drive_DriveFile(array(
//     'name' => 'Invoices',
//     'mimeType' => 'application/vnd.google-apps.folder'));
// $file = $service->files->create($fileMetadata, array(
//     'fields' => 'id'));
// printf("Folder ID: %s\n", $file->id);

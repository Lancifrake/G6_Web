<?php

require __DIR__ . '/vendor/autoload.php';

// Charger les identifiants depuis le fichier config.php
$config = require __DIR__ . '/config.php';

use Google\Client as Google_Client;
use Google\Service\Gmail;

$client = new Google_Client();
$client->setApplicationName('AppSuite');
$client->setScopes(Gmail::MAIL_GOOGLE_COM);
$client->setAuthConfig([
    'client_id' => $config['client_id'],
    'client_secret' => $config['client_secret'],
    'redirect_uris' => [$config['redirect_uri']],
]);
$client->setAccessType('offline');

// Authentification
if (empty($config['access_token'])) {
    $client->fetchAccessTokenWithRefreshToken($config['refresh_token']);
    file_put_contents($config['access_token_file_path'], json_encode($client->getAccessToken()));
} else {
    $client->setAccessToken($config['access_token']);
}

if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($config['refresh_token']);
    file_put_contents($config['access_token_file_path'], json_encode($client->getAccessToken()));
}

$service = new Gmail($client);

 // Création du corps du message
$messageBody = "Name: " . $_POST['name'] . "\r\n";
$messageBody .= "Username: " . $_POST['username'] . "\r\n";
$messageBody .= "Message: " . $_POST['message'];

// Adresse e-mail du destinataire
$to = 'mybosskoko10@gmail.com';

// Création de la requête pour l'envoi de l'e-mail
$rawMessage = rtrim(strtr(base64_encode("To: $to\r\nSubject: Sujet de l'e-mail\r\n\r\n$messageBody"), '+/', '-_'), '=');
$msg = new Google_Service_Gmail_Message();
$msg->setRaw($rawMessage);

// Envoi de l'e-mail
try {
    $service->users_messages->send("me", $msg);
  // Enregistrez le succès dans une variable de session
        $_SESSION['message'] = 'success';
} catch (Exception $e) {
      // Enregistrez l'erreur dans une variable de session
        $_SESSION['message'] = 'error';
        $_SESSION['message_error_message'] = $service->ErrorInfo;
}
    // Redirection après l'envoi du formulaire (facultatif)
    header('Location: portal.html?message=' . $_SESSION['message']);
    exit();
?>
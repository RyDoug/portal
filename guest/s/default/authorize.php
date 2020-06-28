<?php

/*
 * Please see license.txt for information about the origional creator of this
 * php document.
 */

// Start the session to get access to the saved variables
session_start();

// Unifi Connection details
$unifi = array(
          'unifiServer' => "https://localhost:8443",
          'unifiUser'   => "admin",
          'unifiPass'   => "password"
        );

function sendAuthorization($id, $minutes, $unifi) {

  // Outputs input data from the form to a csv file.
   if ($_POST["newsletter"]){
   $fh = fopen(".\out.csv", "a");
   $txt = array(
             $_POST["first-name"],
             $_POST["last-name"],
             $_POST["email"]
   );
 }

  fputcsv($fh, $txt);
  fclose($fh);

  // Start Curl for login
  $ch = curl_init();
  // We are posting data
  curl_setopt($ch, CURLOPT_POST, TRUE);
  // Hide output
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // Set up cookies
  $cookie_file = "/tmp/unifi_cookie";
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
  // Allow Self Signed Certs
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_SSLVERSION, 1);
  // Login to the UniFi controller
  curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer']."/api/login");

  $data = json_encode(array("username" => $unifi['unifiUser'],"password" => $unifi['unifiPass']));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);

  // Send user to authorize and the time allowed
  $data = json_encode(array(
          'cmd'=>'authorize-guest',
          'mac'=>$id,
          'minutes'=>$minutes));

  // Make the API Call
  curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer'].'/api/s/default/cmd/stamgr');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$data);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec ($ch);

  
  // Logout of the connection
  curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer']."/logout");
  curl_exec ($ch);
  curl_close ($ch);

  sleep(3); // Small sleep to allow controller time to authorize
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // If the form has been posted allow them through.
  sendAuthorization($_SESSION['id'], '1', $unifi);
  header('Location: https://google.com/', true, 302);
  exit;
}
?>

<?php

  header('Content-Type: application/json');

  $fdata = $_POST;

  $service_url = 'https://app.polymathx.com/api/contacts/add';

  if($_SESSION && $_SESSION['token'] && $fdata['csrf_token']) {
    // Check that the CSRF token matches the submitted.
    if($_SESSION['token'] !== $fdata['csrf_token']) {
      echo json_encode( ['error' => 'Bad session.'] );
      return false;
    }

    // Check the Honeypot
    if($fdata['how_can_we_help'] && strlen($fdata['how_can_we_help']) > 0) {
      echo json_encode( ['error' => 'Please try again.'] );
      return false;
    }

    if($fdata['contact']) {
      // Create a connection
      $ch = curl_init();

      // Form data string
      $final_data = ['api_key'=>CONFIG['api_key'], 'contact' => json_encode( $fdata['contact'] )];


      // Set curl opts
      curl_setopt($ch, CURLOPT_URL, $service_url);
      curl_setopt($ch, CURLOPT_POST, count($final_data));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);

      # Get the response
      $result = curl_exec($ch);
      curl_close($ch);

    } else {
      $result = $fdata;
      $result['error'] = 'No contact form data.';
      echo json_encode( $result );
    }
  } else {
    echo json_encode( ['error' => 'Bad session.'] );
  }

?>

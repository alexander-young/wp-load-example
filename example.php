<?php

$path = preg_replace( '/wp-content.*$/', '', __DIR__ );
require_once( $path . 'wp-load.php' );

for ($i=1; $i < 5; $i++) { 
  $response = wp_remote_retrieve_body( wp_remote_get("https://swapi.co/api/planets/?page=".$i) );
  $planets = json_decode($response)->results;
  foreach($planets as $planet){
    $inserted_planet = wp_insert_post([
      'post_title' => $planet->name,
      'post_content' => $planet->terrain
    ], true);

    if( is_wp_error($inserted_planet) ){
      echo $planet->name . ' could not be inserted </br>';
    }else {
      echo '<strong>'.$planet->name.' was inserted successfully</strong> </br>';
    }
  }
}

<?php
  function HowLongAgo($date) {
    $start  = date_create($date);
    $end 	= date_create(); // Current time and date
    $diff  	= date_diff( $start, $end );
    $output = "";

    if ($diff->i != 0){
      $output = $diff->i." min ago";
    }
    if ($diff->h != 0){
      $output = $diff->h." hours ago";
    }
    if ($diff->d != 0){
      $output = $diff->d." days ago";
    }
    if ($diff->m != 0){
      $output = $diff->m." months ago";
    }
    if ($diff->y != 0){
      $output = $diff->y." years ago";
    }
    return $output;
  }
?>

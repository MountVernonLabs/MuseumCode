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
      if ($diff->h > 1){
        $plural_h = "s";
      }
      $output = $diff->h." hour".$plural_h." ago";
    }
    if ($diff->d != 0){
      if ($diff->d > 1){
        $plural_d = "s";
      }
      $output = $diff->d." day".$plural_d." ago";
    }
    if ($diff->m != 0){
      if ($diff->m > 1){
        $plural_m = "s";
      }
      $output = $diff->m." month".$plural_m." ago";
    }
    if ($diff->y != 0){
      if ($diff->y > 1){
        $plural_y = "s";
      }
      $output = $diff->y." year".$plural_y." ago";
    }
    return $output;
  }
?>

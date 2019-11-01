<?php
function rand_char($length) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(mt_rand(33, 126));
  }
  return $random;
}
echo rand_char(55); 
?>

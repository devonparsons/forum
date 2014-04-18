<?php

/**
 *  echo nest function
 *  @return the passed string, prepended with "  " for each function in the stack trace, and appends a new line
 *
 */
function echon($string){
  $nest_level = count(debug_backtrace()) - 1; // minus one to ignore the call to *this* function
  echo str_repeat("  ", $nest_level) . $string . "\n";
}

function print_rn($array)
{
    $nest_level = count(debug_backtrace()) - 1; // minus one to ignore the call to *this* function
    $lines = explode("\n", print_r($array, true));

    foreach ($lines as $line) {
        echo str_repeat("  ", $nest_level) . $line . "\n";
    }
}
function print_set(&$string_to_check){
  if (isset($string) && gettype($string) == "string" && strlen($string) > 0 ){
    echo $string . "\n";
  }
}

function print_set_pre($prepend, &$string_to_check){
  echo $prepend;
  print_set($string_to_check);
}


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
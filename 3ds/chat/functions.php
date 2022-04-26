<?php
/**
 * Split a string using a delimiter and return two strings split on the the nth occurrence of the delimiter.

 *  @param string  $source
 *  @param integer $index - one-based index
 *  @param char    $delimiter
 *
 * @return array  - two strings 
 */
function strSplit($source, $index, $delim)
{
  $outStr[0] = $source;
  $outStr[1] = '';

  $partials = explode($delim, $source);

  if (isset($partials[$index]) && strlen($partials[$index]) > 0) {
     $splitPos = strpos($source, $partials[$index]);

     $outStr[0] = substr($source, 0, $splitPos - 1);
     $outStr[1] = substr($source, $splitPos);
  }

  return $outStr;
}

?>
<?php

/*  --------------------  DATE/TIME  --------------------  */

/**
 * * Check Default Timezone
 * -- checks the user's current timezone against the current set timezone
*/
function checkDefaultTimezone()
{
  $tz = date_default_timezone_get();
  if (strcmp($tz, ini_get('date.timezone'))) {
    echo 'Script timezone and ini-set timezone match.';
    return false;
  } else {
    echo 'Script timezone and ini-set timezone match.';
    return true;
  }
}


/*  ---------------------  PRINT  ---------------------  */

/**
 * * Error -> [ console.log ]
 * -- Logs to console that an error has occured
 */
function error($output, $with_script_tags = true)
{
  $js_code = 'console.log("error: ' . json_encode($output, JSON_HEX_TAG) .
      ');';
  if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}



/*  -----------------  SANITIZATION  -----------------  */

/**
 * * Only alphanumeric characters
 * -- returns filtered string containing only alphanumeric characters and '.'
 */
function onlyAlpha($string)
{
  $string = strtolower(preg_replace("[^A-Za-z0-9.]", "", $string));
  return $string;
}

/**
 * * Sanitize String
 * --  Sanitizes string based on desired security level --
 * @param $string -> string set to be sanitized
 * @param $level  -> security level of sanitization (levels 1-6)
 * @return string -> Fully sanitized version of string
 */
function sanitizeString($string, $level)
{
  switch ($level)
  {
    case 1:
      $string = htmlspecialchars($string);
      break;
    case 2:
      $string = htmlspecialchars($string, ENT_QUOTES);
      break;
    case 3:
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = htmlspecialchars($string, ENT_QUOTES);
      break;
    case 4:
      $string = htmlentities($string);
      break;
    case 5:
      $string = htmlentities($string, ENT_QUOTES);
      break;
    case 6:
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = htmlentities($string, ENT_QUOTES);
      break;
    default:
      break;
  }
  return $string;
}

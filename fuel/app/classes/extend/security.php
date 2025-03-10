<?php
class Security extends Fuel\Core\Security
{
  public static function htmlentities($value, $flags = null, $encoding = null, $double_encode = null)
  {
    static $already_cleaned = array();

    is_null($flags) and $flags = \Config::get('security.htmlentities_flags', ENT_QUOTES);
    is_null($encoding) and $encoding = \Fuel::$encoding;
    is_null($double_encode) and $double_encode = \Config::get('security.htmlentities_double_encode', false);

    // Nothing to escape for non-string scalars, or for already processed values
    if (is_null($value) or is_bool($value) or is_int($value) or is_float($value) or in_array($value, $already_cleaned, true))
    {
      return $value;
    }

    if (is_string($value))
    {
      $value = htmlentities($value, $flags, $encoding, $double_encode);
    }
    elseif (is_object($value) and $value instanceOf \Sanitization)
    {
      $value->sanitize();
      return $value;

    }
    elseif (is_array($value) or ($value instanceof \Iterator and $value instanceof \ArrayAccess))
    {
      // Add to $already_cleaned variable when object
      is_object($value) and $already_cleaned[] = $value;

      foreach ($value as $k => $v)
      {
        $value[$k] = static::htmlentities($v, $flags, $encoding, $double_encode);
      }
    }
    elseif ($value instanceof \Iterator or get_class($value) == 'stdClass')
    {
      // Add to $already_cleaned variable
      $already_cleaned[] = $value;

      foreach ($value as $k => $v)
      {
        $value->{$k} = static::htmlentities($v, $flags, $encoding, $double_encode);
      }
    }
    elseif (is_object($value))
    {
      // Check if the object is whitelisted and return when that's the case
      foreach (\Config::get('security.whitelisted_classes', array()) as $class)
      {
        if (is_a($value, $class))
        {
          // Add to $already_cleaned variable
          $already_cleaned[] = $value;

          return $value;
        }
      }

      // Throw exception when it wasn't whitelisted and can't be converted to String
      if ( ! method_exists($value, '__toString'))
      {
        throw new \RuntimeException('Object class "'.get_class($value).'" could not be converted to string or '.
          'sanitized as ArrayAccess. Whitelist it in security.whitelisted_classes in app/config/config.php '.
          'to allow it to be passed unchecked.');
      }

      $value = static::htmlentities((string) $value, $flags, $encoding, $double_encode);
    }

    return $value;
  }
}

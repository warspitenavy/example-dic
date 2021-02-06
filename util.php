<?php
class Util
{
  function h($str)
  {
    if (empty($str) || $str == null) {
      return '';
    }
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}

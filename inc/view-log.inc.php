<?php
if(is_file('log/'.PATH_LOG)) {
  $logs = file('log/'.PATH_LOG);
  echo "<ol>";
  foreach ($logs as $log) {
    $arrLog = explode('|', $log);
    // list($dt, $page, $ref) = explode('|', $log);
    echo "<li>";
    echo date('d-m-Y H-i-s', $arrLog[0]), ' - ', $arrLog[1], ' -> ', $arrLog[2], '<br>';
    echo "</li>";
  }
  echo "</ol>";
}

<?php
if(is_file('log/'.PATH_LOG)) {
  $logs = file('log/'.PATH_LOG);
  foreach ($logs as $log) {
    $arrLog = explode('|', $log);
    echo date('d-m-Y H-i-s', $arrLog[0]), ' - ', $arrLog[1], ' -> ', $arrLog[2], '<br>';
  }
}

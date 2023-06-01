<table width="100%">
	<tr>
		<td align="left">
		<?php
        $result = 0;
        if(isset($_SESSION['test'])) {
            $answers = parse_ini_file('answers.ini');
            foreach ($_SESSION['test'] as $value) {
                
                if(array_key_exists($value, $answers)){
                    $result += $answers["$value"];
                }
            }
            session_destroy();
        }    
        ?>
        <p> Ваш результат: <?= $result; ?> </p>
		</td>
	</tr>
</table>
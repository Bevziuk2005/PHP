<?php
    $ar = array();
    for ($i = 0; $i <= 10; $i++) {
        $a = rand(0, 100);
        $ar[] = $a;
    };

    echo "LIST: ";

    foreach ($ar as $v) {
        echo "$v ";
    };

    echo "\n" . "Max: " . max($ar);
    echo "\n" . "Min: " . min($ar);
    
    $b = 0;
    for ($i=0; $i<count($ar); $i++){
        $b += $ar[$i];
    }
    $b /= count($ar);
    echo "\n" . "Optimal: " . $b . "\n";
?>

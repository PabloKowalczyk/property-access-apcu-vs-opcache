<?php

for ($i = 1; $i < 200; $i++) {
    $dtoName = "Dto{$i}";
    $content = \file_get_contents('src/Dto.php');
    $content = \str_replace(
        "class Dto",
        "class {$dtoName}",
        $content
    );

    \file_put_contents("src/{$dtoName}.php", $content);
}

<?php

use Symfony\Component\PropertyAccess\PropertyAccessor;

require_once 'vendor/autoload.php';

$createDtos = function (int $count): array {
    $dtos = [];
    for ($j = 0; $j < $count; $j++) {
        for ($i = 1; $i < 200; $i++) {
            $dtoName = "\App\Dto{$i}";
            $dtos[] = new $dtoName;
        }
    }

    return $dtos;
};

$bench = function (
    int $times,
    PropertyAccessor $propertyAccessor,
    array $dtos,
    array $data
): float {
    $runTimes = [];
    for ($i =0; $i < $times; $i++) {
        $start = \microtime(true);

        foreach ($dtos as $index => $dto) {
            $dtoData = $data[$index];

            foreach ($dtoData as $key => $value) {
                $propertyAccessor->setValue(
                    $dto,
                    $key,
                    $value
                );
            }
        }

        $dtoData = $data[$index];

        foreach ($dtoData as $key => $value) {
            $propertyAccessor->getValue($dto, $key);
        }

        $runTimes[] = \microtime(true) - $start;
    }

    return \array_sum($runTimes) / \count($runTimes);
};

$dtos = $createDtos(1000);

$data = \array_map(
    function (): array {
        return [
            'prop1' => \bin2hex(\random_bytes(6)),
            'prop2' => \random_int(0, 999),
            'prop3' => [],
            'prop4' => new stdClass(),
            'prop5' => \M_PI
        ];
    },
    \array_fill(
        0,
        900000,
        0
    )
);

$cacheApcu = Symfony\Component\PropertyAccess\PropertyAccessor::createCache(
    'pa',
    3600,
    1
);

$cacheOpcache = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter();

$propertyAccessor = new PropertyAccessor(
    false,
    false
);

$times = 20;

echo 'No cache: ' . $bench(
    $times,
    new PropertyAccessor(
        false,
        false
    ),
    $createDtos(1000),
    $data
);

echo PHP_EOL . 'APCu: ' . $bench(
    $times,
    new PropertyAccessor(
        false,
        false,
        $cacheApcu
    ),
    $createDtos(1000),
    $data
);

echo PHP_EOL . 'OPCache: '. $bench(
    $times,
    new PropertyAccessor(
        false,
        false,
        $cacheOpcache
    ),
    $createDtos(1000),
    $data
);

echo PHP_EOL;

//\apcu_clear_cache();
//\opcache_reset();
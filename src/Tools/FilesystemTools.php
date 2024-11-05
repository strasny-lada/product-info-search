<?php declare(strict_types = 1);

namespace App\Tools;

final class FilesystemTools
{

    /**
     * @return array<string, mixed>
     */
    public static function loadJsonData(string $filepath): array
    {
        if (!file_exists($filepath)) {
            return [];
        }

        $rawData = file_get_contents($filepath);
        
        return json_decode($rawData, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function storeDataIntoJson(
        string $filepath,
        array $data,
    ): void
    {
        $rawData = json_encode($data, JSON_THROW_ON_ERROR);

        file_put_contents($filepath, $rawData);
    }

}
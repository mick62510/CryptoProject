<?php

namespace App\Http\Factory\Model\Create;

use App\Http\Interface\ModelCreateFactoryInterface;
use App\Models\CryptoEntriesData;
use Illuminate\Filesystem\FilesystemManager;

class CryptoEntriesCreateDataFactory implements ModelCreateFactoryInterface
{

    public function __construct(private readonly FilesystemManager $filesystemManager,)
    {
    }

    public function create(mixed $data): CryptoEntriesData
    {
        $model = new CryptoEntriesData;
        $model->image_before_result = $this->moveFileAndGetFileName($data, 'image_before_result', 'before_');

        return $model;
    }

    public function moveFileAndGetFileName(array $data, string $key, string $prefixName): string
    {
        if (array_key_exists($key, $data) && $data[$key]) {
            $path = $data[$key];
            $explodePath = $this->explodePath($path);
            $newPath = 'images/entries/' . $prefixName . last($explodePath);
            //TODO event mais la flemme
            $this->moveFile($path, $newPath);
            $this->deleteFile($path);

            return $newPath;
        }

        return '';
    }

    private function explodePath($path): array
    {
        return explode('/', $path);
    }

    private function moveFile(string $fullPathFile, string $newPath)
    {
        $this->filesystemManager->disk('public')->move($fullPathFile, $newPath);
    }

    private function deleteFile(string $file): void
    {
        $this->filesystemManager->disk('public')->delete($file);
    }

}

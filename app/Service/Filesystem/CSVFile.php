<?php

declare(strict_types=1);

namespace App\Service\FileSystem;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;

class CSVFile implements FileInterface
{
    private Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param UploadedFile $file
     * @param string $fileName
     * @return null|resource
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function upload(UploadedFile $file, string $fileName)
    {
        $this->storage->disk('local')->put($fileName, $file->get());

        return $this->storage->disk('local')->readStream($fileName);
    }
}

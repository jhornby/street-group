<?php

declare(strict_types=1);

namespace App\Service\Filesystem;

use Illuminate\Http\UploadedFile;

interface FileInterface
{
    /**
     * @param UploadedFile $file
     * @param string $fileName
     * @return null|resource
     */
    public function upload(UploadedFile $file, string $fileName);
}

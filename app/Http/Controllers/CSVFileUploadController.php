<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UploadCSVRequest;
use App\Service\FileSystem\CSVFile;

class CSVFileUploadController extends Controller
{
    public function index()
    {
        return view('csv');
    }

    public function upload(UploadCSVRequest $request, CSVFile $file)
    {
        $data = $request->validated();

        $uploadedFileCsv = $file->upload($data['file'], 'people.csv');

        return view('csv');
    }
}

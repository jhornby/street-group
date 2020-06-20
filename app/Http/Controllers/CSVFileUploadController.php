<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Person\PeopleCollection;
use App\Http\Requests\UploadCSVRequest;
use App\Service\FileSystem\CSVFile;

class CSVFileUploadController extends Controller
{
    public function index()
    {
        return view('csv');
    }

    public function upload(UploadCSVRequest $request, CSVFile $file, PeopleCollection $peopleCollection)
    {
        $data = $request->validated();

        $uploadedFileCsv = $file->upload($data['file'], 'people.csv');

        $people = $peopleCollection
            ->fromCsv($uploadedFileCsv);

        return view('csv', ['people' => $people]);
    }
}

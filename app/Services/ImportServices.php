<?php
namespace App\Services;

use App\Models\Service;
use Illuminate\Http\Request;
class ImportServices {

    public static function import(Request $request)
{
    // Retrieve the uploaded file from the request
    $file = $request->file('file');
    $filePath = $file->getRealPath();

    // Open the file for reading
    $handle = fopen($filePath, 'r');

    // Read the first row (header)
    $header = fgetcsv($handle);

    // Read the rest of the rows (data)
    while (($row = fgetcsv($handle)) !== false) {
        // Combine the header and data into a single array
        $data = array_combine($header, $row);

        // Insert the data into the database using Eloquent ORM
        Service::create($data);
    }

    // Close the file
    fclose($handle);
}

}

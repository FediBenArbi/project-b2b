<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

class ExportServices {

public static function export()
{
    $data = DB::table('services')->get();
    // $filename = "data_export" . ".csv";
    $filename = public_path('csv/file.csv');
    $handle = fopen($filename, 'w+');
    // $handle = fopen("file.csv", 'w+');
    fputcsv($handle, array('title', 'description', 'category_id'));

    foreach ($data as $row) {
        fputcsv($handle, (array) $row);
    }

    fclose($handle);
        return ('Data exported successfully.');}}

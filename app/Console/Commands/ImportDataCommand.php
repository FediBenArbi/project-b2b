<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\Service;
use App\Jobs\SendJobDoneEmail;


class ImportDataCommand extends Command
{
    protected $signature = 'import:services';

    protected $description = 'Import products from a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $csvFile = Storage::disk('local')->get('file.csv');
        $csv = Reader::createFromString($csvFile);
        // $header = $csv->fetchOne();
        // $records = $csv->fetchAssoc($header);
        // $csv = Reader::createFromString($file);
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            Service::create([
                'title' => $record['title'],
                'description' => $record['description'],
                'category_id' => $record['category_id']
            ]);
        }

        $this->info('Products imported successfully!');
        dispatch(new SendJobDoneEmail('fedibenarbi22@gmail.com'));

    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;
use SplTempFileObject;
use App\Jobs\SendJobDoneEmail;

class ExportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $records = DB::table('services')->get()->toArray();
        $records = array_map(function ($record) {
            return (array) $record;
        }, $records);
    
        // $csv = Writer::createFromFileObject(new SplTempFileObject());
        // $csv->insertOne(array_keys((array)$data[0]));
        // $csv->insertAll($data);
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        // Insert the header row
        $csv->insertOne(array_keys($records[0]));

        // Insert the data rows
        foreach ($records as $row) {
            $csv->insertOne($row);
        }

    
        Storage::disk('local')->put('dataexported.csv', $csv->getContent());
    
        $this->info('Data exported successfully to data.csv');
        dispatch(new SendJobDoneEmail('fedibenarbi22@gmail.com'));



    }
    
    
    
}

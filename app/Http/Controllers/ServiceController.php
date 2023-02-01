<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use App\Models\Service;
use App\Http\Requests\StorePostRequest;
use App\Services\ServicesforService\StoreService;
use App\Services\ServicesforService\UpdateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;
use SplTempFileObject;
use App\Jobs\SendJobDoneEmail;
use App\Services\ExportServices;
use App\Services\ImportServices;

class ServiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Service::all();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        StoreService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request)
    {
        UpdateService::update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
    }
    public function import(Request $request)
    {
        ImportServices::import($request);
        return ('Data imported successfully');

    }
    public function export()
    {
        ExportServices::export();
        return ('Data exported successfully.');
    }
}

       
<?php
namespace App\Services\ServicesforService;

use App\Models\Service;
use App\Http\Requests\StorePostRequest;


class StoreService {

    public static function store(StorePostRequest $request){
        
    $service=Service::create([
        "title"=> $request->title,
        "description"=> $request->description,
        "category_id"=>$request->category_id
    ]);
    return "service ajouté avec succes+$service";
}
}

<?php
namespace App\Services\ServicesforService;

use App\Models\Service;
use App\Http\Requests\StorePostRequest;


class UpdateService {

    public static function update(StorePostRequest $request){
        
    Service::whereId($request->id)->update([
        "title"=> $request->title,
        "description"=> $request->description,
        "category_id"=>$request->category_id
    ]);
}
}

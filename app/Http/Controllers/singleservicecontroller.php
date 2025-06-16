<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSingleServiceRequest;
use App\interfaces\services\singleservicerepositoryinterface;

class singleservicecontroller extends Controller
{
    private $SingleService;
 //singl ser is like a discount on one service like cleaninng teeth
 // group is like put more than one service and buy it 
    public function __construct(singleservicerepositoryinterface $SingleService)
    {
        $this->SingleService =$SingleService;
    }

    
    public function index()
    {
        return $this->SingleService->index();
       
    }

    
    public function store(StoreSingleServiceRequest $request)
    {
    return $this->SingleService->store($request);
    }



    public function update(StoreSingleServiceRequest $request)
    {
        return $this->SingleService->update($request);
    }


    public function destroy(StoreSingleServiceRequest $request)
{
    return $this->SingleService->destroy($request);
}

}

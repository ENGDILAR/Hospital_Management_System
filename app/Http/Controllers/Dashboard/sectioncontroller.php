<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\interfaces\sections\SectionRepositoryInterface;
use Illuminate\Http\Request;


//php artisan make:controller dashboard\sectioncontroller --resource 
class sectioncontroller extends Controller
{

    private $sections;
    public function __construct(SectionRepositoryInterface $sections)
    {
        $this->sections= $sections;
    }
    
    public function index()
    {

   return $this->sections->index(); 


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->sections->store($request); 
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return $this->sections->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
     return $this->sections->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        return $this->sections->destroy($request);
    }
    //
}

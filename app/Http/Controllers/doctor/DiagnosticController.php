<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    private $diagnostic;

    public function __construct(DiagnosisRepositoryInterface $diagnos)
    {
        $this->diagnostic=$diagnos;
    }

    public function index()
    {

    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        return $this->diagnostic->store($request);
    }

    public function show($id)
    {
        return $this->diagnostic->show($id);
    }

    
    public function addReview (Request $request)
    {
        return $this->diagnostic->addReview($request);
    }

    
    public function edit($id)
    {
        
    }

}

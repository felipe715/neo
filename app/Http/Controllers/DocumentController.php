<?php

namespace App\Http\Controllers;

use App\Document;
use App\Services\DocumentService;
use App\Statistic;
use App\Utils;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ['status' => true, 'data' => $this->documentService->findBy($request->all())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //to do
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'required|string',
            'number' => 'required|string',
            'blacklist' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()];
        }

        try{
            return ['status' => true, 'data' => $this->documentService->save($request->all())];
        }catch (\Exception $e){
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ['status'=> true, 'data' => $this->documentService->findById($id)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //to do
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'required|string',
            'number' => 'required|string',
            'blacklist' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()];
        }

        if($request->type == 'cpf'){
            if(!Utils::validateCpf($request->number)){
                return ['status' => false, 'message' => 'Invalid CPF'];
            }
        }elseif (!Utils::validateCnpj($request->number)){
            return ['status' => false, 'message' => 'Invalid CNPJ'];
        }

        return ['status' => true, 'data' => $this->documentService->update($request->all(), $id)];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->documentService->delete($id)){
            return ['status' => true];
        }else{
            return ['status' => false];
        }
    }
}

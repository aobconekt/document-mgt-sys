<?php

namespace App\Http\Controllers;

use Validator;
use App\Document;
use Illuminate\Http\Request;
use illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDATION OF USER UPLOAD AND SAVING TO DATABASE
        $validator = Validator::make($request->all(), [
            'document'   => 'required|mimes:doc,pdf,docx'
        ]);
        if ($validator->fails()) {
            return redirect('home')
                        ->withErrors($validator)
                        ->withInput();
        }else {

                $document = new Document();
                $document->user_id = Auth::user()->id;
                $document->name = $request->document->getClientOriginalName();
                $document->file_path = $request->document;
                $document->save();

                $files= $request->file('document');
                $files->storeAs('public', $files->getClientOriginalName());
                // return Storage::putFile('public', $files);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $getUserId= Auth::user()->id;
        $getDocuments= $document->all()->where('user_id', '=', $getUserId);

        return view('home', [
            'getDocuments' => $getDocuments
        ]);
    }

    // FUNCTION FOR DOWNLOADING UPLOADED FILES
    public function getDownload()
    {
        $file= public_path(). "storage/app/public";

        $headers = array(
                'Content-Type: application/pdf',
                'Content-Type: application/doc',
                'Content-Type: application/docs',
                );

        return Response::download($file, 'filename.pdf', $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Document $document)
    {
        $delDoc= $document->find($id)->delete();

        return redirect()->back();
    }
}

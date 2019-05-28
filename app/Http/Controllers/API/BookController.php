<?php

namespace App\Http\Controllers\API;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Validation
        $rules = [
            'title'=>'required',
            'content'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            $book           = new Book;
            $book->title    = $request->title; 
            $book->desc     = $request->content;
            $book->created_by = Auth::user()->id;
            $book->active   = 1;
            $book->created_at = now();
            if($book->save()){
                return response()->json(['success' => 'Book successfully added!'], $this->successStatus); 
            } 
            else{ 
                return response()->json(['error'=> 'Unauthorised'], 401); 
            }
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
        $book = Book::find($id);
        if(!empty($book)){
            return response()->json(['success' => $book], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Validation
        $rules = [
            'title'=>'required',
            'content'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            $book = Book::find($id);
            if($book){
                $book_data = [
                    'title'      => $request->title,
                    'desc'       => $request->content,
                    'updated_at' => now(),
                    'updated_by' => Auth::user()->id
                ];
                $book->update($book_data);

                return response()->json(['success' => 'Successfully Updated!'], $this->successStatus); 
            } 
        }

        return response()->json(['error'=> 'Unauthorised'], 401); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book){
            if($book->delete()){
                return response()->json(['success' => 'Successfully Deleted!'], $this->successStatus); 
            }
        } else {
            return response()->json(['message' => "Can't found the book!"]);
        }
        
        return response()->json(['error' => 'Unauthorised'], 401); 
    }
}

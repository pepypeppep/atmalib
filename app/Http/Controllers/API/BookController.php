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
    public function index(Request $request)
    {
        // Check for limit request
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 10;
        }
        // Get books data
        $books = Book::paginate($limit);
        return response()->json(['success' => $books], $this->successStatus);
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
            // Add new book
            $book           = new Book;
            $book->title    = $request->title; 
            $book->desc     = $request->content;
            $book->created_by = Auth::user()->id;
            $book->active   = 1;
            $book->created_at = now();
            if($book->save()){
                return response()->json(['success' => 'Book successfully added!'], $this->successStatus); 
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
        // Find the book
        $book = Book::find($id);
        if($book){
            return response()->json(['success' => $book], $this->successStatus); 
        } else {
            return response()->json(['message' => "Can't found the book!"]);
        }
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
            // Find the book
            $book = Book::find($id);
            if($book){
                // Update book data
                $book_data = [
                    'title'      => $request->title,
                    'desc'       => $request->content,
                    'updated_at' => now(),
                    'updated_by' => Auth::user()->id
                ];
                $book->update($book_data);

                return response()->json(['success' => 'Successfully Updated!'], $this->successStatus); 
            } else {
                return response()->json(['message' => "Can't found the book!"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the book
        $book = Book::find($id);
        if($book){
            // Delete if exist
            if($book->delete()){
                return response()->json(['success' => 'Successfully Deleted!'], $this->successStatus); 
            }
        } else {
            return response()->json(['message' => "Can't found the book!"]);
        }
    }
}

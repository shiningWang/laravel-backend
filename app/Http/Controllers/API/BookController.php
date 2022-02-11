<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Validator;
use DB;

class BookController extends Controller
{
    public function read(Request $request)
    {
        $result = DB::select('select * from books');
        return ($result);
    }

    public function create(Request $request)
    {
        // Collect Request Formdata Into Validator
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
        ]);

        // return Error Message If Data Invalid / Incorrect
        if ($validation -> fails() ) {
            return response()->json($validation->errors());
        };

        // try validate the existence of book with same name
        $exist = Book::where('name', $request->name)->get();
        if (count($exist) == 0) {
            // create book in books
            $book = Book::create([
                'name' => $request->name,
                'author' => $request->author,
                'publisher' => $request->publisher
            ]);
            return ($book);
        } else {
            return('Name Exists, Please Enter Another Book');
        };
    }

    public function delete(Request $request)
    {
        // Collect Request Formdata Into Validator
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        // return Error Message If Data Invalid / Incorrect
        if ($validation -> fails()) {
            return response()->json($validation->errors());       
        };

        $result = Book::where('name', $request->name)->delete();

        if ($result == true) {
            return('Deleted');
        } else{
            return('Book Does Not Exist');
        };
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        // return Error Message If input Invalid / Incorrect
        if ($validation -> fails()) {
            return response()->json($validation->errors());       
        };

        $result = Book::where('name', $request->name);

        // define the value type
        $thisType = $request->type;

        if ($result->get()[0]->$thisType == $request->value) {
            return ('No Change Has Been Made, Please Make A Change');
        } else {
            // make change and return result
            $changeResult = $result->update([$request->type => $request->value]);
            return($changeResult);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Book::paginate(7);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $file = $request->file('book');

        $book = [
            'title' => $file->getClientOriginalName(),
            'description' => $request->description,
            'url' => asset(Storage::url($file->store("public/books"))),
            'extension' =>  $file->extension(),
            'file_size' =>  $file->getSize(),
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ];
        Book::insert($book);
        return $book;
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();
        // return Auth::user()->role;
        return response()->json([
            "message" => "Deleted successfully",
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    use ApiResponse;

    /**
     * The default form rules
     *
     * @var array
     */
    protected $rules = [
        "title"         => ['required', 'string', 'max:255'],
        "description"   => ['required', 'string', 'max:3000'],
        "price"         => ['required', 'regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$', 'max:11'],
        "author_id"     => ['required', 'max:8'],
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            Book::paginate(15),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rules);

        $book = Book::create($data);

        return $this->response(
            $book,
            "Book created sucessfully",
            Response::HTTP_CREATED,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);

        return $this->response($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $book)
    {
        $book = Book::findOrFail($book);

        $data = $this->validate($request, $this->rules);

        $book->fill($data);

        if($book->isClean()) {
            return $this->response(
                [],
                "At least one value must change",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $book->save();

        return $this->response(
            $book,
            "Book {$book->name} updated sucessfully",
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return $this->response(
            [],
            "Book {$book->name} deleted sucessfully",
            Response::HTTP_OK
        );
    }
}

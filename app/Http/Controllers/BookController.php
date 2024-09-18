<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

    class BookController extends Controller
    {
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');

        $allowedSorts = ['id', 'name', 'title', 'author', 'year', 'description', 'rating'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $books = Book::select('books.*')
                    ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
                    ->with('category')
                    ->orderBy($sort === 'name' ? 'categories.name' : $sort, $direction)
                    ->paginate(10)
                    ->appends(['sort' => $sort, 'direction' => $direction]);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:1',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact(['book', 'categories']));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('edit', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('delete', 'Buku berhasil dihapus.');
    }
}

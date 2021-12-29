<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use View;
use Response;

use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    const PAGES = 4;


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->sort) {
            if ('name_asc' == $request->sort) {
                $authors = Author::orderBy('name')->paginate(self::PAGES)->withQueryString();
            } else if ('name_desc' == $request->sort) {
                $authors = Author::orderBy('name', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_asc' == $request->sort) {
                $authors = Author::orderBy('created_at', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_desc' == $request->sort) {
                $authors = Author::orderBy('created_at')->paginate(self::PAGES)->withQueryString();
            } else {
                $authors = Author::paginate(self::PAGES)->withQueryString();
            }
        } else {
            $authors = Author::paginate(self::PAGES)->withQueryString();
        }

        return view('author.index', [
            'authors' => $authors,
            'sort' => $request->sort
        ]);
    }

    public function list(Request $request)
    {
        if ($request->sort) {
            if ('name_asc' == $request->sort) {
                $authors = Author::orderBy('name')->paginate(self::PAGES)->withQueryString();
            } else if ('name_desc' == $request->sort) {
                $authors = Author::orderBy('name', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_asc' == $request->sort) {
                $authors = Author::orderBy('created_at', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_desc' == $request->sort) {
                $authors = Author::orderBy('created_at')->paginate(self::PAGES)->withQueryString();
            } else {
                $authors = Author::paginate(self::PAGES)->withQueryString();
            }
        } else {
            $authors = Author::paginate(self::PAGES)->withQueryString();
        }
        $authors->withPath('');
        $html = View::make('author.list')
            ->with('authors', $authors)
            ->render();

        return Response::json([
            'html' => $html,
            'status' => 'OK' // tiesiog kaip pvz
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'author_name' => 'required|max:64|min:2|alpha',
                'author_surname' => 'required|max:64|min:2|alpha',
            ],
            // [
            //     'author_name.required' => 'Oh, no, there is name missing'
            // ]
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }


        $author = new Author;

        $author->handlePortret($request);

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
        return redirect()
            ->route('author_index')
            ->with('success_message', 'OK. New author was created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('author.show', ['author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Author $author)
    {
        return view('author.edit', [
            'author' => $author,
            'return' => $request->return ?? ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'author_name' => 'required|max:64|min:2|alpha',
                'author_surname' => 'required|max:64|min:2|alpha',
            ],
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }


        $author->handlePortret($request, 'edit');

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;

        $author->save();

        if ($request->return) {
            return redirect('authors/' . $request->return)
                ->with('success_message', 'OK. The author was edited.');
        }

        return redirect()
            ->route('author_index')
            ->with('success_message', 'OK. The author was edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->getBooks->count()) {
            return redirect()
                ->back()
                ->with('info_message', 'Can not delete the author, because he has books.');
        }
        $author->deleteOldPortret();
        $author->delete();
        return redirect()
            ->route('author_index')
            ->with('success_message', 'OK. The author was deleted.');
    }
}

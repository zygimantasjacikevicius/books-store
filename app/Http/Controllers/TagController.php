<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;

class TagController extends Controller
{

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

        // Collection PHP sortBy(a), sortByDesc(a)
        // MariaDB DB orderBy(a), orderBy(a, 'desc')


        if ($request->sort) {
            if ('name_asc' == $request->sort) {
                $tags = Tag::orderBy('name')->get();
            } else if ('name_desc' == $request->sort) {
                $tags = Tag::orderBy('name', 'desc')->get();
            } else if ('new_asc' == $request->sort) {
                $tags = Tag::orderBy('created_at', 'desc')->get();
            } else if ('new_desc' == $request->sort) {
                $tags = Tag::orderBy('created_at')->get();
            } else {
                $tags = Tag::all(); // invalid sort input
            }
        } else {
            $tags = Tag::all(); // w/o sort
        }

        return view('tag.index', [
            'tags' => $tags,
            'sort' => $request->sort ?? ''

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
                'tag_name' => 'required|max:64|min:2|alpha',
            ],
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $tag = new Tag;
        $tag->name = $request->tag_name;
        $tag->save();
        return redirect()
            ->route('tag_index')
            ->with('success_message', 'OK. New tag was created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tag.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag,
            'return' => $request->return ?? ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => 'required|max:64|min:2|alpha',
            ],
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $tag->name = $request->tag_name;
        $tag->save();

        if ($request->return) {
            return redirect('tags/' . $request->return)
                ->with('success_message', 'OK. The tag was edited.');
        }

        return redirect()
            ->route('tag_index')
            ->with('success_message', 'OK. The tag was edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()
            ->route('tag_index')
            ->with('success_message', 'OK. The tag was deleted.');
    }
}

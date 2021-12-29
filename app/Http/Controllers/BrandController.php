<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Http\Request;
use View;
use Response;

class BrandController extends Controller
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
        $request->flash();
        if ($request->sort) {
            if ('title_asc' == $request->sort) {
                $brands = Brand::orderBy('title')->paginate(self::PAGES)->withQueryString();
            } else if ('title_desc' == $request->sort) {
                $brands = Brand::orderBy('title', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_asc' == $request->sort) {
                $brands = Brand::orderBy('created_at', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_desc' == $request->sort) {
                $brands = Brand::orderBy('created_at')->paginate(self::PAGES)->withQueryString();
            } else {
                $brands = Brand::paginate(self::PAGES)->withQueryString();
            }
        } else {
            $brands = Brand::paginate(self::PAGES)->withQueryString();
        }



        return view('brand.index', [
            'brands' => $brands,
            'sort' => $request->sort
        ]);
    }

    public function list(Request $request)
    {
        if ($request->sort) {
            if ('title_asc' == $request->sort) {
                $brands = Brand::orderBy('title')->paginate(self::PAGES)->withQueryString();
            } else if ('title_desc' == $request->sort) {
                $brands = Brand::orderBy('title', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_asc' == $request->sort) {
                $brands = Brand::orderBy('created_at', 'desc')->paginate(self::PAGES)->withQueryString();
            } else if ('new_desc' == $request->sort) {
                $brands = Brand::orderBy('created_at')->paginate(self::PAGES)->withQueryString();
            } else {
                $brands = Brand::paginate(self::PAGES)->withQueryString();
            }
        } else {
            $brands = Brand::paginate(self::PAGES)->withQueryString();
        }
        $brands->withPath('');
        $html = View::make('brand.list')
            ->with('brands', $brands)
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
        return view('brand.create');
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
                'brand_title' => 'required|max:64|min:2'
            ]
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }


        $brand = new Brand;

        $brand->handlePortret($request);

        $brand->title = $request->brand_title;


        $brand->save();
        return redirect()->route('brand_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brand.show', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'brand_title' => 'required|max:64|min:2'
            ]
        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $brand->handlePortret($request);
        $brand->title = $request->brand_title;

        $brand->save();
        return redirect()->route('brand_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->getOutfits->count()) {
            return redirect()->back()->with('info_message', 'Cannot delete a brand that has outfits');
        }
        $brand->deleteOldPortret();
        $brand->delete();
        return redirect()->route('brand_index')->with('success_message', 'brand was deleted!');;
    }
}

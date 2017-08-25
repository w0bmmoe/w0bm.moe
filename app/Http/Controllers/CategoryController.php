<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\Banner;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Response
     */
    public function index()
    {
        return view('categories', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $shortname
     * @param int $id
     * @return \Response
     */
    public function showVideo($shortname, $id = null)
    {
        $category = Category::whereShortname($shortname)->first();
        if (is_null($category)) {
            return redirect()->back()->with('error', 'Category not found');
        }
        if (is_null($id)) {
            $video = Video::getRandom($category)->first();
            if (!$video) {
                return redirect()->back()->with('error', 'Category is empty.');
            }
            return redirect($shortname . '/' . $video->id);
        } else {
            // Don't filter on specific video.
            // TODO: Add warning page
            $video = $category->videos()->find($id);
        }
        if (is_null($video)) {
            return redirect()->back()->with('error', 'Category is empty.');
        }

        return view('video', [
            'video' => $video,
            'related' => $category,
            'banner' => Banner::getRandom($video->isSfw())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Response
     */
    public function destroy($id)
    {
        //
    }
}

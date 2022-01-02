<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required',
        ]);

        if ($request->hasFile('post_thumb')) {
            $file_1 = $request->file('post_thumb');
            $extention_1 = $file_1->getClientOriginalExtension();
            $fileName_1 = time() . '.' . $extention_1;
            $file_1->move('upload/imagePostThumb', $fileName_1);
        } else {
            $fileName_1 = "Nal";
        }
        if ($request->hasFile('post_image')) {
            $file_2 = $request->file('post_image');
            $extention_2 = $file_2->getClientOriginalExtension();
            $fileName_2 = time() . '.' . $extention_2;
            $file_2->move('upload/imagePost', $fileName_2);
        } else {
            $fileName_2 = "Nal";
        }
        $posts = new Post();
        $posts->user_id = 0;
        $posts->category_id = $request->category;
        $posts->thumb = $fileName_1;
        $posts->image = $fileName_2;
        $posts->title = $request->title;
        $posts->detail = $request->detail;
        $posts->tags = $request->tags;
        $posts->save();
        return redirect(route('post.index'))->with('msg', 'Data has been added');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $posts = Post::find($id);
        $cates = Category::all();
        return view('admin.post.edit', compact('posts','cates'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required',
        ]);
        $posts = Post::find($id);
        $posts->user_id = 0;
        $posts->category_id = $request->category;
        $posts->title = $request->title;
        $posts->detail = $request->detail;
        $posts->tags = $request->tags;
        if ($request->hasFile('post_thumb')) {
            $destination = 'upload/imagePostThumb/' . $posts->thumb;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file_1 = $request->file('post_thumb');
            $extention_1 = $file_1->getClientOriginalExtension();
            $fileName_1 = time() . '.' . $extention_1;
            $file_1->move('upload/imagePostThumb', $fileName_1);
            $posts->thumb = $fileName_1;
        }
        if ($request->hasFile('post_image')) {
            $destination = 'upload/imagePost/' . $posts->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file_2 = $request->file('post_image');
            $extention_2 = $file_2->getClientOriginalExtension();
            $fileName_2 = time() . '.' . $extention_2;
            $file_2->move('upload/imagePost', $fileName_2);
            $posts->image = $fileName_2;
        }
        $posts->save();
        return redirect(route('post.index'))->with('msg', 'Data has been updated.');
    }


    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $destination_1 = 'upload/imagePostThumb/' . $posts->thumb;
        $destination_2 = 'upload/imagePost/' . $posts->image;
        if (File::exists($destination_1)) {
            File::delete($destination_1);
        }
        if (File::exists($destination_2)) {
            File::delete($destination_2);
        }
        $posts->delete();
        return redirect()->route('post.index')->with('msg', 'Data has been delete');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'image' => 'required',
        ]);
        $categories = new Category();
        $categories->title = $request->title;
        $categories->detail = $request->detail;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move('upload/imageCate', $fileName);
            $categories->image = $fileName;
        }
        $categories->save();
        return redirect(route('category.index'))->with('msg', 'Data has been added');
    }


    public function show($id)
    {
        $categories = Category::find($id);
        return view('admin.category.show', compact('categories'));
    }


    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.category.edit', compact('categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'image' => 'required',
        ]);
        $categories = Category::find($id);
        $categories->title = $request->title;
        $categories->detail = $request->detail;
        if ($request->hasFile('image')) {
            $destination = 'upload/imageCate/' . $categories->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move('upload/imageCate', $fileName);
            $categories->image = $fileName;
        }
        $categories->save();
        return redirect(route('category.index'))->with('msg', 'Data has been updated.');
    }


    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $destination = 'upload/imageCate/' . $categories->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $categories->delete();
        return redirect()->route('category.index')->with('msg', 'Data has been delete');
    }
}

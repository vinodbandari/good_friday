<?php

namespace App\Http\Controllers;

use Image;
use validate;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Category::orderBy('id','Desc')->get();
        $cat_count = Category::count();
        return view('category',compact('category','cat_count'));
    }

    public function addcategory(Request $request)
    {
       // echo "<pre>";
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $category = new Category();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time(). '.' .$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }

        //$category->name = $request['name'];

        $category->name = $request->input('name');
        // $category->slug = $request->input('slug');
        $category->slug = Str::slug($request['slug']);
        $category->description = $request->input('description');
        $category->status = $request->input('status')==TRUE ? '1':'0';
        $category->popular = $request->input('popular')==TRUE ? '1':'0';
        $category->save();
        return redirect('admin/category')->with('message',"category Added Successfully");


    }


    public function editcategory(Request $request)
	{
        //dd($request->input('status'));

		$img = getCategoryDetail($request->input('id'))->image;
		$filename = ($img!=null) ? $img : 'default.jpg';
		 if($request->file('image')!=null)
		 {
        $image = $request->file('image');

		$filename = $request->input('code').'-cat'.'.'.$image->getClientOriginalExtension();
        $input['imagename'] = $filename;
		//unlink($filename);

        $destinationPath = public_path('assets/uploads/category');
		$filepath = $destinationPath."/".$filename;
		if(file_exists($filepath))
		unlink($filepath);
        $img = Image::make($image->getRealPath());
        $img->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
	}
	else{

	}
		try{
			DB::table('categories')
			->where('id', $request->input('id'))
			->update([
            'name'=>$request->input('name'),
			'slug'=>Str::slug($request['slug']),
			'description'=>$request->input('description'),
            'status' => $request->input('status'),
            'popular' => $request->input('popular')==TRUE ? '1':'0',
			'image'=>$filename]);
			return redirect(url()->previous())->with('message', 'Category updated sucessfully');
			}
			catch(Exception $e) {
				return redirect(url()->previous())->with('message', 'Error updating Category');
				}

	}


    // public function update(Request $request,$id)
    // {
    //   $category = Category::find($id);
    //   if($request->hasFile('image'))
    //   {
    //     $path = 'assets/uploads/category/'.$category->image;
    //     if(File::exists($path))
    //     {
    //         File::delete($path);
    //     }
    //     $file = $request->file('image');
    //     $ext = $file->getClientOriginalExtension();
    //     $filename = time(). '.' .$ext;
    //     $file->move('assets/uploads/category/',$filename);
    //     $category->image = $filename;

    //   }
    //   $category->name = $request->input('name');
    //   $category->slug = $request->input('slug');
    //   $category->description = $request->input('description');
    //   $category->status = $request->input('status')==TRUE ? '1':'0';
    //   $category->popular = $request->input('popular')==TRUE ? '1':'0';
    //   $category->update();
    //   return redirect('admin/category')->with('status',"category updated Successfully");
    // }


    public function destroy($id)
    {

        $category = Category::find($id);
        if($category->image)
        {
          $path = 'assets/uploads/category/'.$category->image;
          if(File::exists($path))
          {
              File::delete($path);
          }
        }
        $category->delete();
        return redirect('admin/category')->with('message',"category Deleted Successfully");
    }
}
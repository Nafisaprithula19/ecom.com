<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\CategoryModel;
use Illuminate\Validation\Rule;
use Auth;
use Str;


class CategoryController extends Controller

   
{
    public function list(){
        $data['getRecord'] = CategoryModel::getRecord();
    $data['header_tittle'] = 'Category';
    return view('admin.category.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_category';
        return view('admin.category.add', $data);
        }
        public function insert(Request $request){
           
            request()->validate([
                'slug' => 'required|unique:category']); 

           $category = new CategoryModel;
           $category->name = trim($request->name);
           $category->slug = trim($request->slug);
           $category->status = trim($request->status);
           $category->meta_title = trim($request->meta_title);
           $category->meta_description = trim($request->meta_description);
           $category->meta_keywords = trim($request->meta_keywords);
           $category->created_by = Auth::user()->id;

           $category->button_name = trim($request->button_name);
           $category->is_home = !empty($request->is_home) ? 1:0  ;



           if(!empty($request->file('image_name')))
                    {
                        $file = $request->file('image_name');
                        $ext = $file->getClientOriginalExtension();
                        $randomStr = Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;
                        $file->move('upload/Category/',$filename);
                    $category->image_name = trim($filename);

                    }
           $category->save();

           return redirect('admin/category/list')->with('error', "Category Successfully Created");


            
            }
        public function edit($id){
            $data['getRecord'] = CategoryModel::getSingle($id);
             $data['header_tittle'] = 'Edit Category';
            return view('admin.category.edit', $data);
             }

        public function update($id, Request $request)
        {
          
            request()->validate([
                'slug' => ['required', Rule::unique('category', 'slug')->ignore($id)]
            ]);

           $category = CategoryModel::getSingle($id);
           $category->name = trim($request->name);
           $category->slug = trim($request->slug);
           $category->status = trim($request->status);
           $category->meta_title = trim($request->meta_title);
           $category->meta_description = trim($request->meta_description);
           $category->meta_keywords = trim($request->meta_keywords);

           $category->button_name = trim($request->button_name);
           $category->is_home = !empty($request->is_home) ? 1:0  ;



           if(!empty($request->file('image_name')))
                    {
                        $file = $request->file('image_name');
                        $ext = $file->getClientOriginalExtension();
                        $randomStr = Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;
                        $file->move('upload/Category/',$filename);
                    $category->image_name = trim($filename);

                    }

           
           $category->save();

           return redirect('admin/category/list')->with('error', "Category Successfully Updated");
        }
        public function delete($id){
            $category =  CategoryModel::getSingle($id);
            $category -> is_delete = 1;
            $category->save();
            return redirect()->back()->with('error', "Category Successfully Deleted");
        }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\CategoryModel;
use App\models\SubCategoryModel;
use Illuminate\Validation\Rule;
use Auth;

class SubCategoryController extends Controller
{
    public function list(){
        $data['getRecord'] = SubCategoryModel::getRecord();
    $data['header_tittle'] = 'Sub Category';
    return view('admin.sub_category.list', $data);
    }

    
    public function add(){
        $data['getCategory'] = CategoryModel::getRecord();
        $data['header_tittle'] = 'Add_new_sub-category';
        return view('admin.sub_category.add', $data);
        }

        public function insert(Request $request){
           
            request()->validate([
                'slug' => 'required|unique:sub_category']); 

           $sub_category = new SubCategoryModel;
           $sub_category->category_id = trim($request->category_id);
           $sub_category->name = trim($request->name);
           $sub_category->slug = trim($request->slug);
           $sub_category->status = trim($request->status);
           $sub_category->meta_title = trim($request->meta_title);
           $sub_category->meta_description = trim($request->meta_description);
           $sub_category->meta_keywords = trim($request->meta_keywords);
           $sub_category->created_by = Auth::user()->id;
           $sub_category->save();

           return redirect('admin/sub_category/list')->with('error', "Sub-Category Successfully Created");
}
public function edit($id){
    $data['getCategory'] = CategoryModel::getRecord();
    $data['getRecord'] = SubCategoryModel::getSingle($id);
     $data['header_tittle'] = 'Edit Sub-Category';
    return view('admin.sub_category.edit', $data);
     }

     public function update($id, Request $request)
     {
       
        request()->validate([
            'slug' => ['required', Rule::unique('sub_category', 'slug')->ignore($id)]
        ]);

         $sub_category = SubCategoryModel::getSingle($id);
         $sub_category->category_id = trim($request->category_id);
         $sub_category->name = trim($request->name);
         $sub_category->slug = trim($request->slug);
         $sub_category->status = trim($request->status);
         $sub_category->meta_title = trim($request->meta_title);
         $sub_category->meta_description = trim($request->meta_description);
         $sub_category->meta_keywords = trim($request->meta_keywords);
         
         $sub_category->save();

        return redirect('admin/sub_category/list')->with('error', "Sub-Category Successfully Updated");
     }

     public function delete($id){
        $category =  SubCategoryModel::getSingle($id);
        $category -> is_delete = 1;
        $category->save();
        return redirect()->back()->with('error', "Sub-Category Successfully Deleted");
    }

   
    
    public function get_sub_category(Request $request) {
        $category_id = $request->id;
        $get_sub_category = SubCategoryModel::getRecordSubCategory($category_id);
    
        $html = '<option value="">Select</option>';
        foreach ($get_sub_category as $value) {
            $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
    
        return response()->json(['html' => $html]);
    }
    
    

}

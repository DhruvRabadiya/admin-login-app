<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    public function category(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            if ($request->ajax()) {
                $data = Category::with('parentcategory')->select(['id', 'category_name', 'parent_id', 'url', 'description']);
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('parent_category', function ($row) {
                        return $row->parentcategory ? $row->parentcategory->category_name : 'N/A';
                    })
                    ->addColumn('action', function ($data) {
                        $editButton = '<button type="button" class="editBtn btn btn-primary btn-sm ml-2" data-id="' . $data->id . '">Edit</button>';
                        $deleteButton = '<button type="button" class="deleteBtn btn btn-danger btn-sm ml-2" data-id="' . $data->id . '">Delete</button>';
                        return $editButton . $deleteButton;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $categories = Category::with('parentcategory')->get()->toArray();
            return view('category', compact('user', 'categories'));
        }
        return redirect()->route('profile');
    }


    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => 'Category Deleted Successfully'
            ], 201);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
}

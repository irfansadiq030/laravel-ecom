<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\Datatables;
use Image;

class SubCategoryController extends Controller
{
    // View Category

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::with('category')->select('*')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category_title', function ($row) {
                    return $row->category->title;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('subcategories.edit', $row->id);
                    $deleteUrl = route('delete-subcategory', $row->id);
                    $actionBtn = '<td class="tb-tnx-action">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                                <ul class="link-list-plain">
                                                    <li><a href="#" onclick="confirmDelete()">View</a></li>
                                                    <li><a href="' . $editUrl . '">Edit</a></li>
                                                    <li><a href="' . $deleteUrl . '" >Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $categories = Category::all();
        return view('admin.sub-categories');
    }

    // Add New Category

    public function create()
    {
        $categories = Category::all();
        return view('admin.add-subcategory', compact('categories'));
    }

    // Create SubCategory
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'subcategory_title' => 'required',
            'slug' => 'required|unique:sub_categories',
        ]);

        $SubCategory = new SubCategory();
        $SubCategory->title = $request->input('subcategory_title');
        $SubCategory->slug = $request->input('slug');
        $SubCategory->description = $request->input('description');
        $SubCategory->status = $request->input('subcategory_status');
        $SubCategory->main_category_id = $request->input('main_category_id');
        $SubCategory->save();

        // Saving IMAGE
        if (!empty($request->input('img_id'))) {
            $temp_img = TempImage::find($request->input('img_id'));
            $extArray = explode('.', $temp_img->name);
            $ext = last($extArray);

            $newImgName = $SubCategory->id . '.' . $ext;
            $sPath = public_path() . '/temp/' . $temp_img->name;
            $dPath = public_path() . '/uploads/subcategory/' . $newImgName;

            File::copy($sPath, $dPath);

            // Generate Image Thumbnail
            $dPath = public_path() . '/uploads/subcategory/thumb/' . $newImgName;
            $full_img = Image::make($sPath);
            $thumbnail = $full_img->fit(450, 600);
            $thumbnail->save($dPath);

            // Save SubCategory Again
            $SubCategory->img = $newImgName;
            $SubCategory->save();
        }

        return redirect()->route('sub-categories')->with('msg', 'SubCategory Added successfully!');;
    }

    // Edit Category
    public function edit($category_id)
    {
        // dd($category_id);
        $subcategory_data = SubCategory::find($category_id);
        $category_data = Category::all();

        if (empty($subcategory_data)) {
            return redirect('admin/sub-categories')->with('error', 'Category not found!');
        }

        // return $subcategory_data->title;
        return view('admin.edit-subcategory',)->with(['subcategory_data' => $subcategory_data, 'category_data' => $category_data]);
    }

    // Update Category
    public function update(Request $request)
    {
        $id = $request->input('subcategory_id');
        $SubCategory = SubCategory::find($id);

        if (empty($SubCategory)) {
            return redirect('admin/sub-categories')->with('error', 'Category not found!');
        }
        

        $validated = $request->validate([
            'subcategory_title' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $id . ',id',
        ]);

        $SubCategory->title = $request->input('subcategory_title');
        $SubCategory->slug = $request->input('slug');
        $SubCategory->description = $request->input('description');
        $SubCategory->status = $request->input('subcategory_status');
        $SubCategory->main_category_id = $request->input('main_category_id');
        $SubCategory->save();

        // Old image 
        $old_img = $SubCategory->img;

        // Saving IMAGE
        if (!empty($request->input('img_id'))) {
            $temp_img = TempImage::find($request->input('img_id'));
            $extArray = explode('.', $temp_img->name);
            $ext = last($extArray);

            $newImgName = $SubCategory->id . '.' . $ext;
            $sPath = public_path() . '/temp/' . $temp_img->name;
            $dPath = public_path() . 'uploads/subcategory/' . $newImgName;

            File::copy($sPath, $dPath);

            // Save Category Again
            $SubCategory->img = $newImgName;
            $SubCategory->save();
        }

        // Delete old Image here
        File::delete(public_path() . 'uploads/subcategory/thumb/' . $old_img);
        File::delete(public_path() . 'uploads/subcategory/' . $old_img);


        return redirect('admin/sub-categories')->with('msg', 'SubCategory updated successfully!');
    }

    // Delete Category
    public function delete($id)
    {
        $SubCategory = SubCategory::find($id);

        if (!$SubCategory) {
            return redirect()->route('sub-categories')->with('error', 'Sub Category not found!');
        }

        $SubCategory->delete();

        return redirect()->route('sub-categories')->with('success', 'Sub Category deleted successfully!');
    }

    // Fetch Sub categories with id mathch
    public function fetch(Request $request)
    {
        $subcategory_data = SubCategory::where('main_category_id', $request->category_id)->get();
        $data = [ 
            'status'=>200,
            'msg' => 'fetched',
            'data' => $subcategory_data
        ];
        return json_encode($data);
    }
}

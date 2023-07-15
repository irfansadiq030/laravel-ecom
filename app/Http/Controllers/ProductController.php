<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\Datatables;
use Image;

class ProductController extends Controller
{
    // View Products

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Product::select('*')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $deleteUrl = route('delete-product', $row->id);
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
        return view('admin.products');
    }

    // Add New product
    public function create()
    {
        $categories = Category::all();
        $subCategory = SubCategory::all();
        return view('admin.add-product')->with(['categories'=> $categories, 'subCategory'=> $subCategory]);
    }

    // Create Product
    public function store(Request $request)
    {
        // dd($request->input('product_gallery'));
        $validated = $request->validate([
            'product_title' => 'required',
            'slug' => 'required|unique:products',
            'selling_price' => 'required',
            'quantity' => 'required|numeric',
        ]);
        // dd($request->all());

        $product = new Product();
        $product->title = $request->input('product_title');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->status = $request->input('product_status');
        $product->selling_price = $request->input('selling_price');
        $product->quantity = $request->input('quantity');
        $product->size = $request->input('size');
        $product->category = $request->input('category');
        $product->sub_category = $request->input('sub_category');
        $product->save();

        // Saving Product Images to ProductImage Model

        if (!empty($request->input('product_gallery'))) {

            foreach ($request->product_gallery as $img_id) {
                $ProductImage = new ProductImage();
                $ProductImage->product_id = $product->id;
                // $ProductImage->image = 'NULL';
                
                $temp_img_info = TempImage::find($img_id);
                $extArray = explode('.', $temp_img_info->name);
                $ext = last($extArray);

                $newImgName = $product->id .'-'. $ProductImage->id.'.' . $ext;
                $sPath = public_path() . '/temp/' . $temp_img_info->name;
                $dPath = public_path() . '/uploads/product/' . $newImgName;

                File::copy($sPath, $dPath);

                // Generate Image Thumbnail
                $dPath = public_path() . '/uploads/product/thumb/' . $newImgName;
                $full_img = Image::make($sPath);
                $thumbnail = $full_img->fit(450, 600);
                $thumbnail->save($dPath);

                // Save Product Images
                $ProductImage->image = $newImgName;
                $ProductImage->save();
            }
            
        }

        return redirect()->route('products')->with('msg','Product Added Successfully!');
    }

    // Edit Product
    public function edit($product_id)
    {
        // dd($category_id);
        $product_data = Product::find($product_id);

        if (empty($product_data)) {
            return redirect()->route('products');
        }

        $categories = Category::all();
        $subcategories = SubCategory::where('main_category_id',$product_data->category)->get();

        return view('admin.edit-product',)->with(['categories' => $categories, 'product_data' => $product_data, 'subcategories' => $subcategories]);

        // dd($category_data);

    }

    // Update Product
    public function update(Request $request)
    {
        $id = $request->input('product_id');
        $product = Product::find($id);

        if (empty($product)) {
            return redirect('admin/products')->with('error', 'product not found!');
        }

        $validated = $request->validate([
            'product_title' => 'required',
            'slug' => 'required|unique:products,slug,' . $id . ',id',
            'selling_price' => 'required',
            'quantity' => 'required|numeric',
        ]);
        // dd($request->all());

        $product->title = $request->input('product_title');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->status = $request->input('product_status');
        $product->selling_price = $request->input('selling_price');
        $product->quantity = $request->input('quantity');
        $product->size = $request->input('size');
        $product->category = $request->input('category');
        $product->sub_category = $request->input('sub_category');
        $product->save();

        // Old image 
        $old_img = $product->img;

        // Saving IMAGE
        if (!empty($request->input('img_id'))) {
            $temp_img = TempImage::find($request->input('img_id'));
            $extArray = explode('.', $temp_img->name);
            $ext = last($extArray);

            $newImgName = $category->id . '.' . $ext;
            $sPath = public_path() . '/temp/' . $temp_img->name;
            $dPath = public_path() . '/uploads/category/' . $newImgName;

            File::copy($sPath, $dPath);

            // Save Category Again
            $category->img = $newImgName;
            $category->save();
        }

        // Delete old Image here
        $old_img = $product->img;
        File::delete(public_path() . 'uploads/category/thumb/' . $old_img);
        File::delete(public_path() . 'uploads/category/' . $old_img);


        return redirect('admin/products')->with('msg', 'Product updated successfully!');
    }

    // Delete Product
    public function delete($id)
    {
        $Product = Product::find($id);

        if (!$Product) {
            return redirect()->route('products')->with('msg', 'Product not found!');
        }

        $Product->delete();

        return redirect()->route('products')->with('msg', 'Product deleted successfully!');
    }
}

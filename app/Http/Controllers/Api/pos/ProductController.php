<?php

namespace App\Http\Controllers\Api\pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\shopping\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\pos\Bill;
use App\pos\Product;
use App\pos\SaleDetail;
use App\MyClass\pos\ImageClass;
use Auth;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
        $objImage = new ImageClass('product', $request->file('file'));
        $objImage->uploadImage();

        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->img = $objImage->imageName;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->amount = $request->amount;

        $product->save();
        return response()->json($product);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->barcode = $request->barcode;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->amount = $request->amount;

        if($request->hasFile('file')){ 
            try {
                $objImage = new ImageClass('product', $request->file('file'));
                $objImage->originalName = $product->img;
                $objImage->updateImage();
                $product->img = $objImage->imageName;
            } catch (Exception $e) {
                return response()->json($e);
            }
            
        }
        
        $product->update();
        return response()->json($request->all());
    }

    public function destroy($id)
    {
        $imagePath =  'pos\product\\';
        $product = Product::find($id);
        unlink(public_path($imagePath.$product->img));
        $product->delete();
        return response()->json($product);
    }
}

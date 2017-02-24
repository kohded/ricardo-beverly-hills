<?php

namespace App\Http\Controllers;

use App\Models\Auth\User;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = new ProductModel();
        $products = $products->getProducts(20);

        return view('product.index', [
        	'products' => $products
        ]);
    }

    // Create form for a new product
    public function getCreateView()
    {
    	return view('product.create');
    }

    // Delete a product
    public function deleteProduct($style, $description)
    {
        $deleteProduct = new ProductModel();
        $deleteProduct->deleteProduct($style);

        return redirect()->route('product')
            ->with('message', 'Product ' . $style . ' - ' . $description . ' deleted.');
    }

    // Create product after form is filled out
    public function createProduct(Request $request)
    {
        $this->validate($request, [
            'style'         => 'required|unique:product',
            'description'   => 'required',
            'brand'         => 'required',
            'warranty'      => 'required|integer',
            'color'         => 'required',
            'class'         => 'required',
            'class-desc'    => 'required',
            'launch'        => 'required',
            'discontinued'  => 'nullable'
        ]);

        // Create a Carbon object for the launch date
        $launch_date = Carbon::createFromFormat('m/d/Y', $request->input('launch'));

        // Create a Carbon object if there is a discontinued date
        if($request->input('discontinued'))
        {
            $discontinued_date = 
                Carbon::createFromFormat('m/d/Y', $request->input('discontinued'));
        } else {
            $discontinued_date = NULL;
        }

        $createProduct = new ProductModel();
        $createProduct->createProduct(
            $request->input('style'), 
            $request->input('description'),
            $request->input('brand'),
            $request->input('warranty'),
            $request->input('color'),
            $request->input('class'),
            $request->input('class-desc'),
            $launch_date,
            $discontinued_date
        );

        return redirect()->route('product.create')
            ->with('message', 'Added new product ' . $request->input('style') . ' - ' . $request->input('description'));
    }

    // Get the edit view
    public function getEditView($style)
    {
        $product = new ProductModel();
        $product = $product->getProduct($style);

        return view('product.edit', ['product' => $product]);
    }

    // Edit a product
    public function editProduct(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'description'   => 'required',
            'brand'         => 'required',
            'warranty'      => 'required|integer',
            'color'         => 'required',
            'class'         => 'required',
            'class-desc'    => 'required',
            'launch'        => 'required'
        ]);

        // Create a Carbon object for the launch date
        $launch_date = Carbon::createFromFormat('m/d/Y', $request->input('launch'));

        // Create a Carbon object if there is a discontinued date
        if($request->input('discontinued'))
        {
            $discontinued_date = 
                Carbon::createFromFormat('m/d/Y', $request->input('discontinued'));
        } else {
            $discontinued_date = NULL;
        }

        $editProduct = new ProductModel();
        $editProduct->editProduct(
            $request->input('style'),
            $request->input('description'),
            $request->input('brand'),
            $request->input('warranty'),
            $request->input('color'),
            $request->input('class'),
            $request->input('class-desc'),
            $launch_date,
            $discontinued_date
        );

        return redirect()->route('product.edit', ['style' => $request->input('style')])
            ->with('message', 'Changes saved for product ' . $request->input('style'));
    }
}
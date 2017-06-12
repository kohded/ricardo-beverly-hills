<?php

namespace App\Http\Controllers;

use App\Exceptions\IdDoesntExistException;
use App\Models\Auth\User;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = new ProductModel();
        $products = $products->getProducts(20, $request);

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
    public function deleteProduct(Request $request)
    {
        $style = $request->product_style;

        $deleteProduct = new ProductModel();
        $deleteProduct->deleteProduct($style);

        return redirect()->route('product')
            ->with('message', 'Product ' . $style . ' deleted.');
    }

    // Create product after form is filled out
    public function createProduct(Request $request)
    {
        $this->validate($request, [
            'style'         => 'required|unique:product',
            'description'   => 'required',
            'brand'         => 'required',
            'warranty'      => 'required|integer',
            'guarantee'     => 'required|integer',
            'color'         => 'required',
            'collection'    => 'required',
            'launch'        => 'required'
        ]);

        // Create a Carbon object for the launch date
        $launch_date = Carbon::createFromFormat('m/d/Y', $request->input('launch'));

        $createProduct = new ProductModel();
        $createProduct->createProduct(
            $request->input('style'), 
            $request->input('description'),
            $request->input('brand'),
            $request->input('warranty'),
            $request->input('guarantee'),
            $request->input('color'),
            $request->input('collection'),
            $launch_date
        );

        return redirect()->route('product.create')
            ->with('message', 'Added new product ' . $request->input('style') . ' - ' . $request->input('description'));
    }

    // Get the edit view
    public function getEditView($style)
    {
        $product = new ProductModel();
        $product = $product->getProduct($style);

        if(count($product) > 0) {
            return view('product.edit', ['product' => $product]);
        } else {
            throw new IdDoesntExistException($style, 'Product');
        }
    }

    // Edit a product
    public function editProduct(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'description'   => 'required',
            'brand'         => 'required',
            'warranty'      => 'required|integer',
            'guarantee'     => 'required|integer',
            'color'         => 'required',
            'collection'    => 'required',
            'launch'        => 'required'
        ]);

        // Create a Carbon object for the launch date
        $launch_date = Carbon::createFromFormat('m/d/Y', $request->input('launch'));

        $editProduct = new ProductModel();
        $editProduct->editProduct(
            $request->input('style'),
            $request->input('description'),
            $request->input('brand'),
            $request->input('warranty'),
            $request->input('guarantee'),
            $request->input('color'),
            $request->input('collection'),
            $launch_date
        );

        return redirect()->route('product.edit', ['style' => $request->input('style')])
            ->with('message', 'Changes saved for product ' . $request->input('style'));
    }

    public function setFilter($filterType, $filterOrder, Request $request){

        $request->session()->flash('filterTypeProduct', $filterType);
        $request->session()->flash('filterOrder', $filterOrder);

        return $this->index($request);
    }
}
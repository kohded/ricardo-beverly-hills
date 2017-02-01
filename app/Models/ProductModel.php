<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ProductModel
{
	// Select all products
	public function getProducts()
	{
		$products = DB::table('product')->get();

		return $products;
	}

	// Select product by style
	public function getProduct($style)
	{
		$product = DB::table('product')->where('style', $style)->get();

		return $product;
	}

	// Insert new product
	public function createProduct($style, $description, $brand, $warranty, $color, $class, $class_desc, $launch, $discontinued)
	{
		DB::table('product')->insert([
			'style' 		       => $style,
			'description' 	       => $description,
			'brand'                => $brand,
            'warranty_years'       => $warranty,
            'color'                => $color,
            'class'                => $class,
            'class_description'    => $class_desc,
            'launch_date'          => $launch,
            'discontinued'         => $discontinued
		]);
	}

	// Edit product by style
	public function editProduct($style, $description, $brand, $warranty, $color, $class, $class_desc, $launch, $discontinued)
	{
		DB::table('product')->where('style', $style)->update([
			'style' => $style,
			'description' => $description,
            'brand'                => $brand,
            'warranty_years'       => $warranty,
            'color'                => $color,
            'class'                => $class,
            'class_description'    => $class_desc,
            'launch_date'          => $launch,
            'discontinued'         => $discontinued
		]);
	}

	// Delete product
	public function deleteProduct($style)
	{
		DB::table('product')->where('style', '=', $style)->delete();
	}
}
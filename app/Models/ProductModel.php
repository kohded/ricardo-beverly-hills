<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductModel
{
	// Select all products
	public function getProducts()
	{
		$products = DB::table('product')->paginate(20);

		return $products;
	}

	// Select product by style
	public function getProduct($style)
	{
		$product = DB::table('product')->where('style', $style)->get();

		foreach($product as $key => $value)
		{
			if($value->launch_date)
			{
				$value->launch_date = Carbon::createFromFormat('Y-m-d', $value->launch_date)->format('m/d/Y');
			}
			if($value->discontinued)
			{
				$value->discontinued = Carbon::createFromFormat('Y-m-d', $value->discontinued)->format('m/d/Y');
			}
		}

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
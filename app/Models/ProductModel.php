<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductModel
{
	// Select all products
	public function getProducts($productsPerPage = null, $request = null)
	{
        $searchString = null;
        $searchField = null;
        $brand = "";

        if (isset($request))
        {
            $searchString = $request->input('search');
            $searchField = $request->input('field');
            $brand = $request->input('brand');
        }

        $products = DB::table('product')
            ->when($searchString, function($query) use($searchString, $searchField) {
                if (isset($searchField)) 
                {
                    if ($searchField === 'style')
                    {
                        return $query->where('style', 'like', '%' . $searchString . '%');
                    }
                    else if ($searchField === 'description')
                    {
                        return $query->where('description', 'like', '%' . $searchString . '%');
                    }
                    else if ($searchField === 'warranty')
                    {
                        return $query->where('warranty_years', 'like', '%' . $searchString . '%');
                    }
                    else if ($searchField === 'class')
                    {
                        return $query->where('class', 'like', '%' . $searchString . '%');
                    }
                }
                else
                {
                    return $query->where('style', 'like', '%' . $searchString . '%')
                                ->orWhere('description', 'like', '%' . $searchString . '%')
                                ->orWhere('warranty', 'like', '%' . $searchString . '%')
                                ->orWhere('class', 'like', '%' . $searchString . '%')
                                ->orWhere('class_description', 'like', '%' . $searchString . '%');
                }
            })

            ->when($brand === "rbh", function($query) {
                return $query->where('brand', '=', "Ricardo Beverly Hills");
            })
            ->when($brand === "skye", function($query) {
                return $query->where('brand', '=', "Skye");
            })

            ->when($productsPerPage, function ($query) use ($productsPerPage) {
                return $query->paginate($productsPerPage);
            }, function ($query) {
                return $query->get();
            });

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
<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'message'  => 'Retrieved successfully',
            'status'   => Response::HTTP_OK,
            'products' => ProductResource::collection($products),
        ], Response::HTTP_OK);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json([
            'message' => 'Product created successfully',
            'status'  => Response::HTTP_CREATED,
            'product' => $product,
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'message' => 'Retrieved successfully',
            'status'  => Response::HTTP_OK,
            'product' => new ProductResource($product),
        ], Response::HTTP_OK);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        if (Auth::user()->role_id != 1 && Auth::id() != $product->vendor->user_id) {
            return response()->json([
                'message' => 'You are not authorized to update this product',
                'status'  => Response::HTTP_FORBIDDEN,
            ], Response::HTTP_FORBIDDEN);
        }

        $product->update($request->validated());
        return response()->json([
            'message' => 'Product updated successfully',
            'status'  => Response::HTTP_OK,
            'product' => new ProductResource($product),
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (Auth::user()->role_id != 1 && Auth::id() != $product->vendor->user_id) {
            return response()->json([
                'message' => 'You are not authorized to delete this product',
                'status'  => Response::HTTP_FORBIDDEN,
            ], Response::HTTP_FORBIDDEN);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully',
            'status'  => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

}

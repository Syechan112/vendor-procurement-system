<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterVendor;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{

    public function index()
    {
        $vendors = Vendor::all();
        return response()->json([
            'message' => 'Retrieved successfully',
            'status'  => Response::HTTP_OK,
            'data'    => VendorResource::collection($vendors),
        ], Response::HTTP_OK);
    }
    public function RegiterVendor(RegisterVendor $request)
    {
        $validatedData = $request->validated();

        $vendor = Vendor::create($validatedData);

        return response()->json([
            'message' => 'Vendor created successfully',
            'status'  => Response::HTTP_CREATED,
            'data'    => new VendorResource($vendor),
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return response()->json([
            'message' => 'Retrieved successfully',
            'status'  => Response::HTTP_OK,
            'data'    => new VendorResource($vendor),
        ], Response::HTTP_OK);
    }

    public function update(RegisterVendor $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        if (Auth::user()->role_id != 1 && Auth::id() != $vendor->user_id) {
            return response()->json([
                'message' => 'You are not authorized to edit this vendor',
                'status'  => Response::HTTP_FORBIDDEN,
            ], Response::HTTP_FORBIDDEN);
        }

        $vendor->update($request->validated());

        return response()->json([
            'message' => 'Vendor updated successfully',
            'status'  => Response::HTTP_OK,
            'data'    => new VendorResource($vendor),
        ]);
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        if (Auth::user()->role_id != 1 && Auth::id() != $vendor->user_id) {
            return response()->json([
                'message' => 'You are not authorized to delete this vendor',
                'status'  => Response::HTTP_FORBIDDEN,
            ], Response::HTTP_FORBIDDEN);
        }

        $vendor->delete();

        return response()->json([
            'message' => 'Vendor deleted successfully',
            'status'  => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
}

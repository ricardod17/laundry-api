<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $product,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "product_name" => ['required'],
            "product_price" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $product = Product::create($request->all());

            $response = [
                'message' => 'Data successfully saved.',
                'data' => $product,
            ];

            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Error " . $e->errorInfo,
            ]);
        }
    }

    public function view($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        if (is_null($product)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "product_name" => ['required'],
            "product_price" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $product,
        ]);
    }

    public function delete($id)
    {
        $deletedRows = Product::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
}

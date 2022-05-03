<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Transaction;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function index()
    {
        $category = category::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $category,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function a()
    {
        // $category = DB::table('category')->join('transaction', 'transaction.categoryid', '=', 'category.id')->orderBy('category.updated_at', 'DESC')->paginate(20);
        $category = category::with('transaction')->get();
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $category,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    // public function a()
    // {
    //     $category = category::all();
    //     return view('category', ['category' => $category]);
    // }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "category_name" => ['required'],
            "category_status" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $category = Category::create($request->all());

            $response = [
                'message' => 'Data successfully saved.',
                'data' => $category,
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
        $category = Category::where('id', $id)->firstOrFail();
        if (is_null($category)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "category_name" => ['required'],
            "category_status" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $category = Category::find($id);
        $category->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $category,
        ]);
    }

    public function delete($id)
    {
        $deletedRows = Category::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
}

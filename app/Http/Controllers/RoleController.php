<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CustomerController extends Controller
{
    public function index()
    {
        $Customer = Customer::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $Customer,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => ['required'],
            "alamat" => ['required'],
            "email" => ['required'],
            "telepon" => ['required'],
            "username" => ['required'],
            "password" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $Customer = Customer::create($request->all());

            $response = [
                'message' => 'Data successfully saved.',
                'data' => $Customer,
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
        $Customer = Customer::where('id', $id)->firstOrFail();
        if (is_null($Customer)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $Customer,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nama" => ['required'],
            "alamat" => ['required'],
            "email" => ['required'],
            "telepon" => ['required'],
            "username" => ['required'],
            "password" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $Customer = Customer::find($id);
        $Customer->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $Customer,
        ]);
    }

    public function delete($id)
    {
        $deletedRows = Customer::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
}
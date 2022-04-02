<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\DB;

class JasaController extends Controller
{
    public function index()
    {
        $Jasa = Jasa::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $Jasa,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_jasa" => ['required'],
            "biaya_jasa" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $Jasa = Jasa::create($request->all());

            $response = [
                'message' => 'Data successfully saved.',
                'data' => $Jasa,
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
        $Jasa = Jasa::where('id', $id)->firstOrFail();
        if (is_null($Jasa)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $Jasa,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nama_jasa" => ['required'],
            "biaya_jasa" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $Jasa = Jasa::find($id);
        $Jasa->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $Jasa,
        ]);
    }

    public function delete($id)
    {
        $deletedRows = Jasa::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
}

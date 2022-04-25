<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\DB;
class TransactionController extends Controller
{
    
    public function index()
    {
        $Transaction = Transaction::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $Transaction,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customerid" => ['required'],
            "productid" => ['required'],
            "total_item" => ['required'],
            "price" => ['required'],
            "status_transaction" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $Transaction = Transaction::create($request->all());

            $response = [
                'message' => 'Data successfully saved.',
                'data' => $Transaction,
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
        $Transaction = Transaction::where('id', $id)->firstOrFail();
        if (is_null($Transaction)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $Transaction,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "customerid" => ['required'],
            "productid" => ['required'],
            "total_item" => ['required'],
            "price" => ['required'],
            "status_transaction" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $Transaction = Transaction::find($id);
        $Transaction->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $Transaction,
        ]);
    }

    public function status(Request $request, $id)
    {
        DB::table('Transaction')->where('id', $request->id)->update([
            'status_transaction' => '1',
            ]);
        return response()->json([
            "success" => true,
            "message" => "Data updated as Completed.",
        ]);
    }
    public function delete($id)
    {
        $deletedRows = Transaction::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data successfully deleted.",
            "data" => $deletedRows,
        ]);
    }
}

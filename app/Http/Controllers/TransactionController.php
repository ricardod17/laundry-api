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
        $transaction = Transaction::orderBy('updated_at', 'DESC')->paginate(5);
        $response = [
            'message' => 'Data is successfully retrieved',
            'data' => $transaction,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customerid" => 'required',
            "productid" => 'required',
            "categoryid" => 'required',
            "total_item" => 'required',
            "price" => 'required',
            "status_transaction" => 'required',
        ]);
     

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $arr = [];
        $arr[] = $request->categoryid;

        try {        
            $transaction = Transaction::create($request->all());
            $transaction->category()->attach($transaction->id,['category_id' => $request->categoryid], ['product_id' => $request->productid]);
            $response = [
                'message' => 'Data successfully saved.',
                'data' => $transaction,
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
        $transaction = Transaction::where('id', $id)->firstOrFail();
        if (is_null($transaction)) {
            return $this->sendError('Data not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Data is successfully retrieved",
            "data" => $transaction,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "customerid" => 'required',
            "productid" => 'required',
            "categoryid" => 'required',
            "total_item" => 'required',
            "price" => 'required',
            "status_transaction" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $transaction = Transaction::find($id);
        $transaction->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data successfully updated.",
            "data" => $transaction,
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

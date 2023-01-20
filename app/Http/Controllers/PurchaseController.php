<?php
namespace App\Http\Controllers;
use App\Http\Requests\PurchaseRequest;
use App\ServiceController\PurchaseServiceController;

class PurchaseController extends Controller
{
    public function Add(PurchaseRequest $request, PurchaseServiceController $controller)
    {
        try {
            $data = $controller->add($request);
            return response()->json([
                'success' => 0,
                'msg' => 'successfully',
                'uniqueId' => $data,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
    public function edit(PurchaseRequest $request, PurchaseServiceController $controller)
    {
        try {
            $controller->edit($request);
            return response()->json([
                'success' => 1,
                'msg' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
    public function View(PurchaseRequest $request, PurchaseServiceController $controller)
    {
        try {
            $Purchase = $controller->view($request);
            return response()->json([
                'success' => 1,
                'Purchase' => $Purchase
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
    public function Delete(PurchaseRequest $request, PurchaseServiceController $controller)
    {
        try {
            $controller->delete($request);
            return response()->json([
                'success' => 1,
                'msg' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\ServiceController\FileServiceController;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class FileController extends Controller
{
    public function Add(FileRequest $request,FileServiceController $controller){
        try {
           $data = $controller->add($request);
            return response()->json([
                'success' => 0,
                'msg' =>'successfully',
                'uniqueId'=>$data,
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }

    }
    public function edit(FileRequest $request,FileServiceController $controller){
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
    public function View(FileRequest $request,FileServiceController $controller){
        try {
          $files= $controller->view($request);
            return response()->json([
                'success'=>1,
                'category'=> $files
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
    public function Delete(FileRequest $request,FileServiceController $controller){
        try {
           $controller->delete($request);
            return response()->json([
                'success' => 1,
                'move' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\ServiceController\PostServiceController;

class PostController extends Controller
{
    public function Add(PostRequest $request,PostServiceController $controller){
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
    public function edit(PostRequest $request,PostServiceController $controller){
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
    public function View(PostRequest $request,PostServiceController $controller){
        try {
            $post= $controller->view($request);
            return response()->json([
                'success'=>1,
                'posts'=> $post
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }
    public function Delete(PostRequest $request,PostServiceController $controller){
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\ServiceController\CategoryServiceController;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
public function Add(CategoryRequest $request,CategoryServiceController $controller){
    try {
       $categoryId=$controller->add($request);
        return response()->json([
            'success' => 1,
            'msg' =>'successfully',
            'categoryId'=>$categoryId,
        ]);
    }catch (\Exception $exception) {
        return response()->json([
            'success' => 0,
            'msg' => $exception->getMessage(),

        ]);
    }

}
public function edit(CategoryRequest $request,CategoryServiceController $controller){
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
public function View(CategoryRequest $request,CategoryServiceController $controller){
    try {
        $Categories=$controller->view($request);
        return response()->json([
            'success'=>1,
            'category'=> $Categories,
        ]);
    }catch (\Exception $exception) {
        return response()->json([
            'success' => 0,
            'msg' => $exception->getMessage(),
        ]);
    }
}
public function Delete(CategoryRequest $request,CategoryServiceController $controller){
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

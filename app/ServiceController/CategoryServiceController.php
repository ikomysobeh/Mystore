<?php
namespace App\ServiceController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;

class CategoryServiceController
{
    public function add(CategoryRequest $request)
    {
        $data = $request->validated();
         $data=$request->safe()->all();
        $category = new Category($data);
        if (!$category->save() ){
            throw new \Exception('Category not saved');
        }
        if ( !($data['cover'] =(new CategoryService())->saveFile("cover", "/photo", $request->allFiles()))){
            throw new \Exception('cover not saved');
        }
        return $category->id;
    }

    public function edit(CategoryRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        $category = (new CategoryService())->getFirst(['id' => $data['id']]);
        if ($request->has('cover')) {
            if (Storage::disk('public')->exists($category->cover) &&
                Storage::disk('public')->delete($category->cover)) {
                (new CategoryService())->delete(['id' => $data['id']]);
                throw new \Exception('the file not deleted');
            };
            if (!(new CategoryService())->saveFile("cover", "/photo", $request->allFiles())) {
                throw new \Exception('field to save cover');
            }
        }
        if (!(new CategoryService())->update($data, ['id' => $data['id']])) {
            throw new \Exception('failed to edit');
        }
    }

    public function view(CategoryRequest $request)
    {
        $data = $request->safe()->all();
        $Categories = (new CategoryService())->getListQuery();
        if ($request->has('id')) {
            $Categories = $Categories->where('id', $data['id']);
        }
        if ($request->has('name')) {
            $Categories = $Categories->where('name', $data['name']);
        }
        if ($request->has('search')) {
            $Categories = (new CategoryService())->getListQuery(['keyword' => $data['search']]);
        }
        return $Categories->get();
    }

    public function delete(CategoryRequest $request)
    {
        $data = $request->safe()->all();
        $Category = (new CategoryService())->getFirst(['id' => $data['id']]);
            if (Storage::disk('public')->exists($Category->cover) &&
                Storage::disk('public')->delete($Category->cover)) {
                (new CategoryService())->delete(['id' => $data['id']]);

        }
    }
}
?>

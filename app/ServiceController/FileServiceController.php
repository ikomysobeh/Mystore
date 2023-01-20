<?php
namespace App\ServiceController;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\FileRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class FileServiceController
{
    public function add(FileRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        $data['uniqueId'] = Str::random(32);
        $data['extension'] = $request->file('path')->clientExtension();
        if (!$data['path'] = (new FileService())->saveFile("path", "/file", $request->allFiles())) {
            throw new \Exception('file not saved 1');
        }
        if (!(new FileService())->save($data)) {
            throw new \Exception('file not saved');
        }
        return $data['uniqueId'];
    }

    public function edit(FileRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        $file = (new FileService())->getFirst(['uniqueId' => $data['uniqueId']]);
        if ($request->has('path')) {
            if (Storage::disk('public')->exists($file->path) &&
                Storage::disk('public')->delete($file->path)) {
                (new FileService())->delete(['uniqueId' => $data['uniqueId']]);
            } else {
                throw new NotFound('video not found');
            }
            if (!(new FileService())->saveFile("path", "/file", $request->allFiles())) {
                throw new \Exception('field to save cover');
            }
        }
        if (!(new FileService())->update($data, ['uniqueId' => $data['uniqueId']])) {
            throw new \Exception('failed to edit');
        }
    }

    public function view(FileRequest $request)
    {
        $data = $request->safe()->all();
        $file = (new FileService())->getListQuery();
        if ($request->has('uniqueId')) {
            $files = $file->where('uniqueId', $data['uniqueId']);
        }
        if ($request->has('search')) {
            $files = (new FileService())->getListQuery(['keyword' => $data['search']]);
        }
        return $files->get();
    }

    public function delete(FileRequest $request)
    {
        $data = $request->safe()->all();
        $files = (new FileService())->getFirst(['uniqueId' => $data['uniqueId']]);
        if ($files !== null) {
            if (Storage::disk('public')->exists($files->path) &&
                Storage::disk('public')->delete($files->path)) {
                (new FileService())->delete(['uniqueId' => $data['uniqueId']]);
            } else {
                throw new NotFound('video not deleted');
            }
        } else {
            throw new \Exception('video not found');
        }
    }

}

?>

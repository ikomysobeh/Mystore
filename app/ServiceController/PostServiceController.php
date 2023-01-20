<?php
namespace App\ServiceController;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Support\Str;

class PostServiceController
{
    public function add(PostRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        $data['uniqueId'] = Str::random(32);
        if (!(new PostService())->save($data))  {
            throw new \Exception('Post not saved');
        }
        return $data['uniqueId'];
    }

    public function edit(PostRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        if (!(new PostService())->update($data, ['uniqueId' => $data['uniqueId']])) {
            throw new \Exception('failed to edit');
        }
    }

    public function view(PostRequest $request)
    {
        $data = $request->safe()->all();
        $post = (new PostService())->getListQuery();
        if ($request->has('uniqueId')) {
            $post = $post->where('uniqueId', $data['uniqueId']);
        }
        if ($request->has('price')) {
            $post = $post->where('price', $data['price']);
        }
        if ($request->has('title')) {
            $post = $post->where('title', $data['title']);
        }
        if ($request->has('search')) {
            $post = (new PostService())->getListQuery(['keyword' => $data['search']]);
        }
        return $post->get();
    }

    public function delete(PostRequest $request)
    {
        $data = $request->safe()->all();
        if(!(new PostService())->delete(['uniqueId' => $data['uniqueId']])){
               throw new \Exception('the post not deleted');
           }

        }

}
?>

<?php
namespace App\ServiceController;
use App\Http\Requests\PurchaseRequest;
use App\Services\PostService;
use App\Services\PurchaseService;
use Illuminate\Support\Str;
class PurchaseServiceController
{
    public function add(PurchaseRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        $data['uniqueId'] = Str::random(32);
        if (!(new PurchaseService())->save($data)) {
            throw new \Exception('Purchase not saved');
        }
        return $data['uniqueId'];
    }
    public function edit(PurchaseRequest $request)
    {
        $data = $request->validated();
        $request->safe()->all();
        if (!(new PurchaseService())->update($data, ['uniqueId' => $data['uniqueId']])) {
            throw new \Exception('failed to edit');
        }
    }
    public function view(PurchaseRequest $request)
    {
        $data = $request->safe()->all();
        $post = (new PurchaseService())->getListQuery();
        $post = $post->where('uniqueId', $data['uniqueId']);
        return $post->get();
    }
    public function delete(PurchaseRequest $request)
    {
        $data = $request->safe()->all();
        if (!(new PurchaseService())->delete(['uniqueId' => $data['uniqueId']])) {
            throw new \Exception('the Purchase not deleted');
        }
    }
}
?>

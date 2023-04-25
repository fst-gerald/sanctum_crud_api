<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Models\Content;

class ContentRepository extends BaseRepository implements ContentRepositoryInterface
{
    /**
     * ContentRepository constructor.
     *
     * @param Content $model
     */
    public function __construct(Content $model)
    {
        parent::__construct($model);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->orderBy('updated_at', 'desc')->get();
    }

    public function store($data)
    {
        $content = $this->model->fill($data);
        $content->save();

        return $content;
    }

    public function find($id)
    {
        return $this->model->find($id)->first();
    }

    public function update($data, $id)
    {
        $content = Content::find($id)->first();
        return $content->update($data);
    }

    public function destroy($id)
    {
        $content = Content::find($id)->first();
        $content->delete();
    }
}

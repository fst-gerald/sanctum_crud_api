<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Support\Carbon;

class ContentAdapter implements ContentRepositoryInterface
{
    const WAIT_DELETE_MINUTES = 3;

    private ContentRepositoryInterface $contentRepository;

    /**
     * ContentRepository constructor.
     *
     * @param ContentRepositoryInterface $contentRepository
     */
    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function waitDestroy($data, $id)
    {
        $data['waiting_delete_time'] = Carbon::now()->addMinutes(self::WAIT_DELETE_MINUTES);

        $this->contentRepository->update($data, $id);

        $this->contentRepository->destroy($id);
    }
}

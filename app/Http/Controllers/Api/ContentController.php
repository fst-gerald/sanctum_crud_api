<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContentRequest;
use App\Models\Content;
use App\Repositories\ContentAdapter;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ContentController extends Controller
{
    private ContentRepositoryInterface $contentRepository;

    private ContentAdapter $contentAdapter;

    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contents = $this->contentRepository->all();

        return response()->json($contents, ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function store(ContentRequest $request): JsonResponse
    {
        try {
            $content = $this->contentRepository->store($request->all());

            return response()->json($content, ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Content $content
     * @return JsonResponse
     */
    public function show(Content $content): JsonResponse
    {
        $content = $this->contentRepository->find($content);

        return response()->json($content, ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContentRequest $request
     * @param Content $content
     * @return JsonResponse
     */
    public function update(ContentRequest $request, Content $content): JsonResponse
    {
        try {
            $content = $this->contentRepository->update($request->all(), $content);

            return response()->json($content, ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Content $content
     * @return JsonResponse
     */
    public function destroy(Content $content): JsonResponse
    {
        try {
            $contentData = $this->contentRepository->find($content);

            $this->contentAdapter = new ContentAdapter($this->contentRepository);
            
            $this->contentAdapter->waitDestroy($contentData->toArray(), $content);

            return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

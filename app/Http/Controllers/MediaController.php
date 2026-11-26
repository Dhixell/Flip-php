<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
class MediaController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return MediaResource::collection(
            Media::with('users')->get()
        );
    }

    public function show(Media $medium): MediaResource
    {
        return new MediaResource($medium->load('users'));
    }

    public function store(StoreMediaRequest $request): MediaResource
    {
        $media = Media::create($request->validated());

        return new MediaResource($media);
    }

    public function update(UpdateMediaRequest $request, Media $medium): MediaResource
    {
        $medium->update($request->validated());

        return new MediaResource($medium);
    }

    public function destroy(Media $medium): \Illuminate\Http\JsonResponse
    {
        $medium->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus'
        ]);
    }
}

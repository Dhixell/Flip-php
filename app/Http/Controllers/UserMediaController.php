<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMediaController extends Controller
{
    // Menambahkan media ke koleksi user
    public function attach(Request $request, User $user, Media $medium): JsonResponse
    {
        // Memeriksa apakah media sudah ada di koleksi user
        if ($user->media()->where('media.id', $medium->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Media sudah ada di koleksi user'
            ], 409);
        }

        // Menambahkan media jika belum ada
        $user->media()->attach($medium->id);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil ditambahkan ke koleksi user'
        ]);
    }

    // Menampilkan seluruh media dalam koleksi user
    public function index(User $user): AnonymousResourceCollection
    {
        return MediaResource::collection(
            $user->media()->get()
        );
    }

    // Menghapus media dari koleksi user
    public function detach(User $user, Media $medium): JsonResponse
    {
        $user->media()->detach($medium->id);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus dari koleksi user'
        ]);
    }
}

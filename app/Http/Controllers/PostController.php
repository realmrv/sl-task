<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Auth;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response(Post::where('user_id', Auth::id())
            ->with(['comments'])->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return Response
     */
    public function store(StorePostRequest $request): Response
    {
        return response(Auth::user()->posts()->create($request->validated()));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request): Response
    {
        return response(Auth::user()->comments()->create($request->validated()));
    }
}

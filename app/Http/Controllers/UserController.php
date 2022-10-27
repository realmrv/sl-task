<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response(User::with(['posts', 'posts.comments' => static function ($query) {
            $query->where('user_id', Auth::id());
        }])->paginate(15));
    }
}

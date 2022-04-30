<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForumRequest;
use App\Http\Resources\Forum\ForumCollection;
use App\Http\Resources\Forum\ForumResource;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ForumCollection(Forum::with('user')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        $user = auth()->userOrFail();

        $data = $request->validated();

        $data['slug'] = $data['title'];

        $user->forums()->create($data);

        // return new ForumResource($forum);
        return response()->json(['message' => 'Forum created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        return new ForumResource($forum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request, Forum $forum)
    {
        $this->authorize('owner', $forum);

        $data = $request->validated();

        $forum->update($data);

        // return new ForumResource($forum);
        return response()->json(['message' => 'Forum updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $this->authorize('owner', $forum);

        $forum->delete();

        return response()->json(['message' => 'Forum deleted successfully']);
    }
}

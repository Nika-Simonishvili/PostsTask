<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Interfaces\CachedPostsInterface;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $repository,
        private readonly CachedPostsInterface $service
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = $this->service->index();
        $postObjects = json_decode(json_encode($data, true));

        return view('posts.index', ['posts' => $postObjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $this->repository->store($request->validated());

        return redirect()->route('posts.index')->with('success', 'New post has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = $this->service->find($id);

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = $this->service->find($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id): RedirectResponse
    {
        $this->repository->update($id, $request->validated());

        return redirect()->route('posts.index')->with('success', 'Post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->repository->delete($id);

        return redirect()->route('posts.index')->with('success', 'Post has been deleted.');
    }

    public function search(Request $request)
    {
        $posts = collect(Cache::get('posts'));

        $result = $posts->filter(function ($post) use ($request) {
            return str_contains($post['title'], $request->search) || str_contains($post['body'], $request->search);
        })->map(function ($post) {
            return (object) $post;
        });

        return view('posts.index', ['posts' => collect($result)]);
    }
}

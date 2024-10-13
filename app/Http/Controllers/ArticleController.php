<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\CompanyCollection;
use App\Models\Article;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //$filterByStatus = 'for-edit';
        $query = Article::with(['company', 'writer', 'editor'])->orderBy('created_at', 'desc');

        /*if ($request->has('filterByStatus')) {*/
        /*    $filterByStatus = $request->input('filterByStatus');*/
        /*}*/

        return Inertia::render('Articles/Index', [
            'articles' => $query->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Articles/Create', ['companies' => new CompanyCollection(Company::all())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $article = Article::create([
            'company' => $request->company,
            'image' => 'images/'.$imageName,
            'title' => $request->title,
            'link' => $request->link,
            'date' => $request->date,
            'content' => $request->content,
            'status' => 'for-edit',
            'writer' => Auth::id(),
        ]);

        return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return Inertia::render(
            'Articles/Edit',
            [
                'article' => $article,
                'companies' => new CompanyCollection(Company::all()),
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {

        $validated = $request->validated();

        $article->company = $validated['company'];
        $article->title = $validated['title'];
        $article->link = $validated['link'];
        $article->content = $validated['content'];

        if ($request->status) {
            $article->status = $validated['status'];
            $article->editor = Auth::id();
        }

        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $article->image = 'images/'.$imageName;
        }

        $article->save();

        return redirect()->route('articles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back();

    }
}

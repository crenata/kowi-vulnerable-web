<?php

namespace App\Http\Controllers;

use App\Helpers\StorageHelper;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $query = "select * from articles";
        if (!empty($request->search)) $query .= " where title like '%{$request->search}%'";
        $articles = DB::select($query);
        return view("article.view")->withArticles($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view("article.add");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "title" => "required|string",
            "image" => "required|file",
            "description" => "required|string"
        ]);

        Article::create([
            "title" => $request->title,
            "image" => StorageHelper::save($request, "image", "articles"),
            "description" => $request->description
        ]);

        return redirect()->route("article.index")->withStatus("Successfully added.");
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     */
    public function edit(string $id) {
        $article = Article::findOrFail($id);
        return view("article.edit")->withArticle($article);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "title" => "required|string",
            "image" => "required",
            "description" => "required|string"
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        if ($request->hasFile("image")) $article->image = StorageHelper::save($request, "image", "articles");
        $article->description = $request->description;
        $article->save();

        return redirect()->route("article.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Article::findOrFail($id)->delete();

        return redirect()->route("article.index")->withStatus("Successfully deleted.");
    }
}

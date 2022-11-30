<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category')->orderBy('id' , 'desc')->paginate(6);
        return response()->view('cms.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response()->view('cms.article.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [
            'title' => 'required',
            'category_id' => 'required' ,
          ]);

          if(! $validator->fails()){
              $articles = new Article();
                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/article', $imageName);

                    $articles->image = $imageName;
                    }

              $articles->title = $request->get('title');
              $articles->image = $request->get('image');
              $articles->short_description = $request->get('short_description');
              $articles->full_description = $request->get('full_description');
              $articles->category_id = $request->get('category_id');

              $isSaved = $articles->save();
              if($isSaved){
                  return response()->json(['icon'=>'success' , 'title'=>"Created is successfully"],200);
              }else {
                  return response()->json(['icon'=>'Failed' , 'title'=>"Created is Failed"],400);
              }
          }else{
              return response()->json(['icon'=>'error' , 'title' => $validator->getMessageBag()->first()],400);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $articles = Article::findOrFail($id);
        return response()->view('cms.article.edit' , compact('categories' , 'articles'));
    }

    /**
     * Update the specified resource in storage.

    *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all() , [
            'title' => 'required',
            'category_id' => 'required' ,
          ]);

          if(! $validator->fails()){
              $articles = Article::findOrFail($id);
                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/article', $imageName);

                    $articles->image = $imageName;
                    }

              $articles->title = $request->get('title');
              $articles->image = $request->get('image');
              $articles->short_description = $request->get('short_description');
              $articles->full_description = $request->get('full_description');
              $articles->category_id = $request->get('category_id');

              $isUpdated = $articles->save();
              return ['redirect' => route('articles.index')];
              if($isUpdated){
                  return response()->json(['icon'=>'success' , 'title'=>"Created is successfully"],200);
              }else {
                  return response()->json(['icon'=>'Failed' , 'title'=>"Created is Failed"],400);
              }
          }else{
              return response()->json(['icon'=>'error' , 'title' => $validator->getMessageBag()->first()],400);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::destroy($id);
        return response()->json(['icon'=>'success' , 'title'=>"Deleted is successfully"],200);
    }
}
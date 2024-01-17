<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
/* use PDF; */
use Barryvdh\DomPDF\Facade\PDF;

/* to use raw queries */
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = BlogPost::all();
        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::categorySelect();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newBlog = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);
        return redirect(route('blog.show', $newBlog))->withSuccess(trans('lang.text_blog_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        return view('blog.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {        
        $categories = Category::categorySelect();
        return view('blog.edit', compact('blogPost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);
        return redirect(route('blog.show', $blogPost))->withSuccess('article mis a jour!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect(route('blog.index'))->withSuccess('article supprimé!');
        
    }

    public function pagination() 
    {
        $blog = BlogPost::select()->paginate(5);
        return view('blog.pagination', compact('blog'));
    }

    public function query()
    {
        /* $blog = BlogPost::all(); */

        /* first is the first line of the request, not the first entry in DB */
            /* $blog = BlogPost::Select()->orderby('id', 'desc')->first(); */

        /* $blog = BlogPost::where('id', 2)->get(); */
        
        /* works on primary key only */
            /* $blog = BlogPost::find(2); */

        /* $blog = BlogPost::select('title', 'id')->where('title', 'like', 'test%')->orderby('title')->get(); */

        /* AND does not exist. use double where */
            /* $blog = BlogPost::select('title', 'id')->where('user_id', 1)->where('title','like', '%test')->get(); */

        /* OR */
            /* $blog = BlogPost::select('title', 'id', 'user_id')->where('user_id', 1)->orWhere('id', 3)->get();*/

        /* inner join */
            /* $blog = BlogPost::
                select('title', 'users.name')
                ->join('users', 'blog_posts.user_id', 'users.id')
                ->where('users.name', 'like', 'Ken%')
                ->get(); */


        /* outer join */ 
            /* $blog = BlogPost::
            select('title', 'users.name')
            ->rightJoin('users', 'blog_posts.user_id', 'users.id')
            ->get(); */

        /* counting */
            /* $blog = BlogPost::count('body'); */

        /* max value */
            /* $blog = BlogPost::max('id'); */
        
        /* raw SQL query */
            /* $blog = BlogPost::select(DB::raw('count(*) as blogs, user_id'))
            ->groupBy('user_id')
            ->get(); */

        $blog = BlogPost::find(2);

        return $blog->blogHasUser->name; 
    }

    public function showPdf(BlogPost $blogPost)
    {
        $pdf = PDF::loadView('blog.show-pdf', compact('blogPost'));
        return $pdf->download('blog-'.$blogPost->id.'.pdf');
    }

}

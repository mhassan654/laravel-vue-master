<?php

namespace App\Http\Controllers\Front;
use App\Models\Category;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $data['categories'] = Category::select('id', 'categoryName')->get();
        $data['blogs'] = Blog::orderBy('id', 'desc')->with(['cat', 'user'])->limit(6)->get();
        // dd($data['blogs']);
        return view('home')->with($data);
    }

    public function blogSingle(Request $request, $slug){
        $data['categories'] = Category::all();
        $data['blogDetails'] = Blog::where('slug', $slug)->with(['cat','tag', 'user'])->first();

        $category_ids = [];
        foreach ($data['blogDetails']->cat as $cat)
        {
            array_push($category_ids, $cat->id);
        }

         $data['relatedBlogs'] = Blog::with('user')
        ->where('id', '!=',$data['blogDetails']->id)
        ->whereHas('cat', function($query) use($category_ids){
        $query
        ->whereIn('category_id', $category_ids);
        })
        ->limit(5)
        ->orderBy('id', 'desc')
        ->get(['id', 'title', 'post_excerpt','slug','user_id','featuredImage']);
        // dd( $data['blogDetails']);
        // $data['blogDetails'] = Blog::where('slug', $slug)->with(['cat','tag', 'user'])->get(['id','title','user_id','featuredImage','post']);
        return view('single')->with($data);

    }

    // public function compose(View $view)
    // {
    //     $cat = Category::select(['id', 'categoryName'])->get();
    //     $view->with('cat', $cat);
    // }

    public function categoryIndex($categoryName, $id)
    {
         $data['blogs'] = Blog::with('user')
        ->whereHas('cat', function($query) use($id){
        $query
        ->whereIn('category_id', $id);
        })
        ->orderBy('id', 'desc')
        ->get(['id', 'title', 'post_excerpt','slug','user_id','featuredImage'])->paginate(10);
        return $data['blogs'];
    }
}

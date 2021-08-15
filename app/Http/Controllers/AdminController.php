<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Blogcategory;
use App\Models\Blogtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // first check if you are logged in admin admin user....
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }
        if (!Auth::check() && $request->path() == 'login') {
            return view('welcome');
        }
        // you are already logged in..so check for if you are logged in
        $user = Auth::user();
        if ($user->userType == 'User') {
            return redirect('/login');
        }
        if ($request->path() == 'login') {
            return redirect('/');
        }

        return $this->checkUserPermission($user, $request);
    }

    public function checkUserPermission($user, $request)
    {
        $permission = json_decode($user->role->permission);
        $hasPermission = false;
        if (!$permission) return view('welcome');
        foreach ($permission as $p) {
            if ($p->name == $request->path()) {
                if ($p->read) {
                    $hasPermission = true;
                }
            }
        }
        if ($hasPermission) return view('welcome');
        return view('404');
        // echo $permission[0]->name;
        //      echo $request->path();

    }

    //logout admin
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function addTag(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required'
        ]);
        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function getTags()
    {
        return Tag::orderBy('id', 'desc')->get();
    }

    public function edit_tag(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required',
            'id' => 'required',
        ]);
        return Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);
    }

    public function delete_tag(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Tag::where('id', $request->id)->delete();
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png'
        ]);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }

    // upload image from editor.js
    public function uploadEditorImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);
        $picName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $picName);
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => "http://127.0.01:8000/uploads/$picName"
            ]
        ]);
        return $picName;
    }

    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }

    public function deleteFileFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path() . '/uploads/' . $fileName;
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage' => 'required'

        ]);
        return Category::create([
            'categoryName' => $request->categoryName,
            'iconImage' => $request->iconImage,
        ]);
    }

    public function getCategories()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function editCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImage' => 'required',
            'id' => 'required',
        ]);
        return Category::where('id', $request->id)->update([
            'categoryName' => $request->categoryName,
            'iconImage' => $request->iconImage,

        ]);
    }

    public function delete_category(Request $request)
    {
        $this->deleteFileFromServer($request->iconImage);
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Category::where('id', $request->id)->delete();
    }

    //adddong new admin
    public function createUser(Request $request)
    {
        $this->validate($request, [
            'fullName' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required'
        ]);
        $password = bcrypt($request->fullName);
        return User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id
        ]);
    }

    //updating new admin
    public function edit_user(Request $request)
    {
        $this->validate($request, [
            'fullName' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'role_id' => 'required'
        ]);
        $data = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role_id' => $request->role_id
        ];
        if ($request->password) {
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }

        $user = User::where('id', $request->id)->update($data);
        return $user;
    }

    public function getUsers()
    {
        return User::get();
    }

    public function adminLogin(Request $request)
    {
        // validate request
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role->isAdmin == 0) {
                Auth::logout();
                return response()->json([
                    'msg' => 'Incorrect login details',
                ], 401);
            }
            return response()->json([
                'msg' => 'You are logged in',
                'user'
            ]);
        } else {
            return response()->json([
                'msg' => 'Incorrect login details',
            ], 401);
        }
    }

    // roles functions
    public function addRole(Request $request)
    {
        $this->validate($request, [
            'roleName' => 'required'
        ]);
        return Role::create([
            'roleName' => $request->roleName
        ]);
    }

    // get all roles
    public function get_roles()
    {
        return Role::all();
    }
    public function editRole(Request $request)
    {
        $this->validate($request, [
            'roleName' => 'required',
            'id' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'roleName' => $request->roleName
        ]);
    }

    public function delete_role(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Role::where('id', $request->id)->delete();
    }

    public function assignRole(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required',
            'id' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'permission' => $request->permission
        ]);
    }

    // public function slug()
    // {
    //     $title = 'this is a nice title';
    //     // dd($title);
    //     return Blog::create([
    //         'title' => $title,
    //         'post' => 'some post',
    //         'post_excerpt' => 'jbkjk',
    //         'user_id' => 1,
    //         'metaDescription' => 'jkfdsj'
    //     ]);
    //     return $title;
    // }

    public function addBlog(Request $request)
    {
        $categories = $request->category_id;
        $tags = $request->tag_id;
        $blogTags = [];
        $blogCategories = [];

        DB::beginTransaction();
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->title,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'metaDescription' => $request->metaDescription,
                'jsonData' => $request->jsonData,
            ]);


            // insert categories
            foreach ($categories as $cat) {
                array_push($blogCategories, ['category_id' => $cat, 'blog_id' => $blog->id]);
            }
            Blogcategory::insert($blogCategories);

            // insert tags
            foreach ($tags as $tag) {
                array_push($blogTags, ['tag_id' => $tag, 'blog_id' => $blog->id]);
            }
            Blogtag::insert($blogTags);
            DB::commit();

            return 'done';
        } catch (\Throwable $th) {
            DB::rollBack();
            return 'failed';
        }
    }

    public function blogdata(){
        return Blog::with(['tag','cat'])->orderBy('id','ASC')->get();
    }

    public function deleteBlog(Request $request){
        return Blog::where('id', $request->id)->delete();
    }
}

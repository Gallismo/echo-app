<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\category;
use App\Models\post;
use App\Models\post_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HttpController extends Controller
{
    private static $limit = 50;

    public function authorsList(Request $request) {
        $queries = $request->query();

        $authorModel = author::limit(self::$limit);

        if (isset($queries['page'])) {
            $queries['page'] = $queries['page'] - 1;
            $authorModel = $authorModel->offset($queries['page']*self::$limit);
        }

        if (isset($queries['last_name'])) {
            $authorModel = $authorModel->where('last_name', 'like', "%".$queries['last_name']."%");
        }

        $authors = $authorModel->get();

        return response()->json($authors);
    }

    public function categoryList(Request $request) {
        $queries = $request->query();

        $categoryModel = category::limit(self::$limit);

        if (isset($queries['page'])) {
            $queries['page'] = $queries['page'] - 1;
            $categoryModel = $categoryModel->offset($queries['page']*self::$limit);
        }

        $categories = $categoryModel->get();

        return response()->json($categories);
    }

    public function postList(Request $request) {
        $queries = $request->query();

        $postModel = DB::table('posts')->limit(self::$limit)
            ->select('posts.id', 'posts.name', 'posts.image',
                'posts.anounce', 'posts.text', 'posts.author as author_id',
                DB::raw('concat(authors.last_name, " ", authors.first_name, " ", authors.middle_name) as author_name'))
            ->join('authors', 'posts.author', '=', 'authors.id');

        if (isset($queries['page'])) {
            $queries['page'] = $queries['page'] - 1;
            $postModel = $postModel->offset($queries['page']*self::$limit);
        }

        if (isset($queries['query'])) {
            $categories = category::where('name', 'like', "%".$queries['query']."%")->get();
            $post_categories = [];

            foreach ($categories as $category) {
                $rows = DB::table('post_categories')->select('post_id')
                    ->where('category_id', $category->id)->get();
                foreach ($rows as $row) {
                    $post_categories[] = $row->post_id;
                }
            }

            $postModel = $postModel->where('posts.name', 'like', "%".$queries['query']."%")
                ->orWhere(DB::raw('concat(authors.last_name, " ", authors.first_name, " ", authors.middle_name)'),
                    'like', "%".$queries['query']."%")
                ->orWhereIn('posts.id', $post_categories);
        }

        $posts = $postModel->get();

        foreach ($posts as $post) {
            $post_categories = post_categories::where('post_id', $post->id)->get();
            $post->categories = [];
            foreach ($post_categories as $pc) {
                $category = category::where('id', $pc->category_id)->first();
                $post->categories[] = $category;
            }
        }

        return response()->json($posts);
    }

    public function author ($query) {
        $author = author::where('id', $query)->orWhere('slug', $query)->first();
        return response()->json($author);
    }

    public function category ($query) {
        $category = category::where('id', $query)->orWhere('slug', $query)->first();
        return response()->json($category);
    }

    public function post ($query) {
        $post = post::where('id', $query)->orWhere('slug', $query)->first();
        return response()->json($post);
    }
}

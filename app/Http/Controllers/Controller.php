<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Http\Client\Request;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function fetchData($url, $method = 'GET', $data = null) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data, // Optional: Data to send in the request
        ]);
        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    
        return [
            'status' => $httpStatus,
            'response' => $response,
        ];
    }

    public function index(Request $request)
    {
        $url = 'https://jsonplaceholder.typicode.com/posts/';
        $fetchdata= $this->fetchData($url);

        if ($fetchdata['status'] === 200) {
            $posts = json_decode($fetchdata['response'], true);
            $perPage = 10;
            $currentPage = $request->input('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $paginatedPosts = array_slice($posts, $offset, $perPage);
            $paginatedPosts = new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedPosts,
                count($posts),
                $perPage,
                $currentPage,
                ['path' => route('index.list')] 
            );
            // dd($paginatedPosts);
            return view('index', ['posts' => $paginatedPosts]);
        } else {
            return response()->json(['error' => 'Failed to fetch posts.'], $fetchdata['status']);
        }
    }

    public function postDetails($id)
    {

        $url = 'https://jsonplaceholder.typicode.com/posts/'.$id;
        $fetchdata = $this->fetchData($url);
        $posts = json_decode($fetchdata['response'], true);
        
        $comment_url='https://jsonplaceholder.typicode.com/comments?postId=' . $id;
        $get_comments=$this->fetchData($comment_url);
        
        if ($get_comments['status'] === 200) {
            $paginatedcomment = json_decode($get_comments['response'], true);
            $perPage = 10;
            $currentPage = 1; 
            $paginatedcomment = array_slice($paginatedcomment, ($currentPage - 1) * $perPage, $perPage);
          
            return view('post_details', ['paginatedcomment' => $paginatedcomment, 'post' =>$posts]);
        } else {
            // Return error response
            return response()->json(['error' => 'Failed to fetch posts.'], $get_comments['status']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;
use Illuminate\Support\Facades\DB;


class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {

        
            $videos = array();
            $query = DB::select("SELECT users.id, users.user_name, users.image, videos.url , videos.id AS id_video
            FROM videos
            INNER JOIN users ON users.id = videos.user_id ");

            foreach ($query as $row) {
                $id = $row->id_video;
                $likes = DB::select("SELECT COUNT(id) as likes FROM likes WHERE video_id = $id ");
                $views = DB::select("SELECT COUNT(id) as views FROM views WHERE video_id = $id ");
                $viewed = DB::select("SELECT COUNT(id) as viewed FROM views WHERE video_id = $id AND `user_id` = $request->id");
                $liked = DB::select("SELECT COUNT(id) as liked FROM likes WHERE video_id = $id AND `user_id` = $request->id");
                
                if ($liked[0]->liked < 1) {
                    $liked_post = false;
                } else {
                    $liked_post = true;
                }
                
                if ($viewed[0]->viewed < 1) {
                    $res = [
                        "id" => $row->id,
                        "user_name" => $row->user_name,
                        "image" => $row->image,
                        "url" => $row->url,
                        "id_video" => $row->id_video,
                        "liked" => $liked_post,
                        "likes" => $likes[0],
                        "views" => $views[0]
                        
                    ];
                    array_push($videos, $res);
                } 
            }

            return $videos;
        }
        else{
            return 'nothing';
        }
    }

    public function videoLiked(Request $request)
    {
        if ($request->id) {

        
            $videos = array();
            $query = DB::select("SELECT users.id, users.user_name, users.image, videos.url , videos.id AS id_video
            FROM videos
            INNER JOIN users ON users.id = videos.user_id ");

            foreach ($query as $row) {
                $id = $row->id_video;
                $likes = DB::select("SELECT COUNT(id) as likes FROM likes WHERE video_id = $id ");
                $views = DB::select("SELECT COUNT(id) as views FROM views WHERE video_id = $id ");
                $viewed = DB::select("SELECT COUNT(id) as viewed FROM views WHERE video_id = $id AND `user_id` = $request->id");
                $liked = DB::select("SELECT COUNT(id) as liked FROM likes WHERE video_id = $id AND `user_id` = $request->id");
                
                if ($liked[0]->liked < 1) {
                    $liked_post = false;
                } else {
                    $liked_post = true;
                    $res = [
                        "id" => $row->id,
                        "user_name" => $row->user_name,
                        "image" => $row->image,
                        "url" => $row->url,
                        "id_video" => $row->id_video,
                        "liked" => $liked_post,
                        "likes" => $likes[0],
                        "views" => $views[0]
                        
                    ];
                    array_push($videos, $res);
                }
            }

            return $videos;
        }
        else{
            return 'nothing';
        }
    }

    public function videoViewed(Request $request)
    {
        if ($request->id) {

        
            $videos = array();
            $query = DB::select("SELECT users.id, users.user_name, users.image, videos.url , videos.id AS id_video
            FROM videos
            INNER JOIN users ON users.id = videos.user_id ");

            foreach ($query as $row) {
                $id = $row->id_video;
                $likes = DB::select("SELECT COUNT(id) as likes FROM likes WHERE video_id = $id ");
                $views = DB::select("SELECT COUNT(id) as views FROM views WHERE video_id = $id ");
                $viewed = DB::select("SELECT COUNT(id) as viewed FROM views WHERE video_id = $id AND `user_id` = $request->id");
                $liked = DB::select("SELECT COUNT(id) as liked FROM likes WHERE video_id = $id AND `user_id` = $request->id");
                
                if ($liked[0]->liked < 1) {
                    $liked_post = false;
                } else {
                    $liked_post = true;
                }
                
                if ($viewed[0]->viewed > 0) {
                    $res = [
                        "id" => $row->id,
                        "user_name" => $row->user_name,
                        "image" => $row->image,
                        "url" => $row->url,
                        "id_video" => $row->id_video,
                        "liked" => $liked_post,
                        "likes" => $likes[0],
                        "views" => $views[0]
                        
                    ];
                    array_push($videos, $res);
                } 
            }

            return $videos;
        }
        else{
            return 'nothing';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')) {
            $destination = 'public/videos';
            $video = $request->file('video');
            $videoName = $request->user_name . rand(1, 1000) . $request->user_id . rand(1, 1000) . '.mp4';
            $path = $request->file('video')->storeAs($destination, $videoName);

            video::create([
                "user_id" => $request->user_id,
                "url" => "http://localhost:8000/storage/videos/" . $videoName
            ]);

            return 'video saved';
        }else{
            return $request;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

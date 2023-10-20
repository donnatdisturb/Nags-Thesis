<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Comment;

use View;
use DB;

class CommentController extends Controller
{
    public function infos($id)
    {
        $comments = DB::table('comments')
            ->join('announcements','announcements.id','comments.announcement_id')
            ->select('comments.name AS name', 'comments.email', 'comments.comment', 'comments.created_at')
            ->where('announcements.id', '=', "$id")
            ->orderBy('comments.created_at','DESC')
            ->get();

        $announcements = Announcement::findOrFail($id);
        return View::make('announcements.show',compact('comments','announcements'));
    }

    public function create(Request $request){

        $commentss = app('profanityFilter')->filter($request->comment);
        $query = DB::table('comments')->insert([
            'created_at' => now(),
            'name' => $request->input('name'),
            'email'=> $request->input('email'),
            'announcement_id'=> $request->input('announcement_id'),
            'comment' => $commentss,
        ]);

        DB::commit();
        return redirect()->back()->with('status','Comment Added Successfully');
    }
}

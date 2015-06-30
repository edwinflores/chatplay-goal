<?php namespace App\Http\Controllers;

use App\Chat;
use App\ChatLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\ChatUser;
use Illuminate\Support\Facades\Session;
use Exception;

class ChatplayController extends Controller {

    public function main()
    {
        return view('chatplay');
    }

    public function login()
    {
        $input = Input::all();

        $input['gravatar'] = md5(strtolower(trim($input['email'])));

        $user = DB::table('webchat_users')->where('name', $input['name'])->first;

        if(empty($user)) {
            return redirect()->back()->with('msg', 'This name is already in use');
        }

        $user = new ChatUser();
        $user->create($input);

        Session::put(['name' => $user->name, 'gravatar' => $user->gravatar]);

        return ['status' => 1, 'name' => $user->name, 'gravatar' => Chat::gravatarFromHash($user->gravatar)];
    }

    public function logout()
    {
        DB::table('webchat_users')->where('name', Session::get('name'))->delete();

        Session::flush();
        Session::regenerate();

        return array('status' => 1);
    }

    public function submitChat($chatText)
    {
        if(!Session::has('name')) {
            throw new Exception('You are not logged in');
        }

        if(!$chatText) {
            throw new Exception('You haven\'t entered a message.');
        }

        $chat = new ChatLine();
        $chat->create([
            'author'    =>  Session::get('name'),
            'gravatar'  =>  Session::get('gravatar'),
            'text'      =>  $chatText
        ]);

        return array(
            'status'    =>  1,
            'insertID'  =>  $chat
        );
    }

    public function getUsers()
    {
        if(Session::has('name')) {
            $user = ChatUser::findByName(Session::get('name'));
            $user->last_activity = Carbon::now();
            $user->save();
        }

        DB::table('webchat_lines')->whereRaw('ts < SUBTIME(NOW(),\'0:5:0\')');
        DB::table('webchat_users')->whereRaw('last_activity < SUBTIME(NOW(),\'0:0:30\')');

        $users = DB::table('webchat_users')->orderBy('name', 'ASC')->take(18)->get();
        foreach ($users as $user) {
            $user->gravatar = Chat::gravatarFromHash($user->gravatar, 30);
        }

        return [
            'users' =>  $users,
            'total' =>  count($users)
        ];
    }

    public function getChats($lastID)
    {
        $lastID = (int)$lastID;

        $chats = DB::table('webchat_lines')->where('id', '>', $lastID)->orderBy('id', 'ASC')->get();

        foreach ($chats as $chat) {
            $chat->time = [
                'hours'     =>  gmdate('H', strtotime($chat->ts)),
                'minutes'   =>  gmdate('i', strtotime($chat->ts))
            ];

            $chat->gravatar = Chat::gravatarFromHash($chat->gravatar);
        }

        return array('chats' => $chats);
    }

}

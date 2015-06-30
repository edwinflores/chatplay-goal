<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Chat extends Model {

    public static function gravatarFromHash($gravatar, $size=23)
    {
        return 'http://www.gravatar.com/avatar/'.$gravatar.'?size='.$size.'&default='.
            urlencode('http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?size='.$size);
    }

    public static function checkLoggedIn()
    {
        $response = array('logged' => false);

        if (Session::has('user') && Session::has('name')) {
            $response['logged'] = true;
            $response['loggedAs'] = [
                'name'      =>  Session::get('name'),
                'gravatar'  =>  Chat::gravatarFromHash(Session::get('gravatar'))
            ];
        }

        return $response;
    }
}

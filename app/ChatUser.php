<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model {

    private $table = 'webchat_users';

    protected $fillable = [
        'name',
        'gravatar',
        'last_activity',
        'created_at',
        'updated_at'
    ];

    public static function create($data)
    {
        $params = [
            'name'        => $data['name'],
            'gravatar'      => $data['gravatar'],
            'last_activity' => Carbon::today(),
            'created_at'    => Carbon::today(),
            'updated_at'    => Carbon::today()
        ];

        $user = new ChatLine($params);
        $user->save();

        return $user;
    }

    public static function findByName($name)
    {
        $user = DB::table('webchat_users')->where('name', $name)->first();

        return $user;
    }
}

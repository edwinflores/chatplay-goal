<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model {

    private $table = 'webchat_lines';

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
            'author'        => $data['name'],
            'gravatar'      => $data['gravatar'],
            'last_activity' => Carbon::today(),
            'created_at'    => Carbon::today(),
            'updated_at'    => Carbon::today()
        ];

        $app = new ChatLine($params);
        $app->save();

        return $app;
    }
}

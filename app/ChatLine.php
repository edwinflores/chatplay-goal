<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChatLine extends Model {

	private $table = 'webchat_lines';

    protected $fillable = [
        'author',
        'gravatar',
        'text',
        'ts',
        'created_at',
        'updated_at'
    ];

    public static function create($data)
    {
        $params = [
            'author'    => $data['author'],
            'gravatar'  => $data['gravatar'],
            'text'      => $data['text'],
            'ts'        => Carbon::today(),
            'created_at'=> Carbon::today(),
            'updated_at'=> Carbon::today()
        ];

        $app_id = DB::table('webchat_lines')->insertGetId($params);

        return $app_id;
    }
}

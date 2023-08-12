<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'error';

    protected $fillable = ['exception', 'message', 'code', 'file',
        'line', 'severity', 'trace', 'user_agent',
        'referer', 'ip', 'port', 'uri',
        'request', 'method', 'route', 'route_action',
        'user_id', 'checked'];

}

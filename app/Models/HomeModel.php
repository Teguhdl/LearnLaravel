<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    use HasFactory;

    protected $table = 'user';

    public function cekUsernamePassword($username, $password)
    {
        $results = DB::table($this->table)
            ->where('username', $username)
            ->where('password', md5($password))
            ->count();

        return $results;
    }
}

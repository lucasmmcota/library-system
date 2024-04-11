<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['full_name', 'id_member_type', 'email', 'phone', 'cpf', 'id_user'];

    /**
     * Method to list the members
     * @access private
     * @return array array of members
     */
    public function lstMember()
    {
        return Member::query()
            ->select('m.id', 'm.full_name', 'm.email', 'm.phone', 'm.cpf', 'mt.type')
            ->from('member as m')
            ->join('member_type as mt', 'm.id_member_type', '=', 'mt.id')
            ->orderBy('full_name')
            ->get()
            ->toArray();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['type'];

    /**
     * Method to list the members type
     * @access private
     * @return array array members type
     */
    public function lstMemberType()
    {
        return MemberType::query()
            ->select('mt.id', 'mt.type')
            ->from('member_type as mt')
            ->orderBy('type')
            ->get()
            ->toArray();
    }
}

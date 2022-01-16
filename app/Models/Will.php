<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Will extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'firstName', 'middleName', 'lastName', 'email', 'dob',
        'hasPartner', 'hasChildrenUnderEighteen', 'hasMirrorWill', 'ownProperty',
        'addressSummary', 'secondApplicant', 'secondExecutor', 'eachOtherExecutor',
        'executor', 'reserveExecutor', 'giftOptions', 'giftMoney', 'giftCharity',
        'giftBank', 'giftProperty', 'giftPet', 'businessAssignment', 'residueDetails',
        'requestDetails', 'appointGuardian', 'hasMoreThanOneChildren', 'sameGuardianAllChildren',
        'children', 'reserveGuardian'
    ];

    protected $casts = [
        'hasPartner' => 'boolean',
        'hasChildrenUnderEighteen' => 'boolean',
        'hasMirrorWill' => 'boolean',
        'ownProperty' => 'boolean',
        'eachOtherExecutor' => 'boolean',
        'appointGuardian' => 'boolean',
        'hasMoreThanOneChildren' => 'boolean',
        'sameGuardianAllChildren' => 'boolean',
        'addressSummary' => 'json',
        'secondApplicant' => 'json',
        'secondExecutor' => 'json',
        'executor' => 'json',
        'reserveExecutor' => 'json',
        'giftOptions' => 'json',
        'giftMoney' => 'json',
        'giftCharity' => 'json',
        'giftBank' => 'json',
        'giftProperty' => 'json',
        'giftPet' => 'json',
        'businessAssignment' => 'json',
        'residueDetails' => 'json',
        'requestDetails' => 'json',
        'children' => 'json',
        'reserveGuardian' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

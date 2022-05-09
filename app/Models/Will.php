<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Will
 *
 * @property int $id
 * @property int $user_id
 * @property string $firstName
 * @property string|null $middleName
 * @property string $lastName
 * @property string $email
 * @property string $dob
 * @property bool $hasPartner
 * @property bool $hasChildrenUnderEighteen
 * @property bool $hasMirrorWill
 * @property bool $ownProperty
 * @property array|null $addressSummary
 * @property array|null $secondApplicant
 * @property bool $eachOtherExecutor
 * @property array|null $executor
 * @property array|null $reserveExecutor
 * @property array|null $giftOptions
 * @property array|null $giftMoney
 * @property array|null $giftCharity
 * @property array|null $giftBank
 * @property array|null $giftProperty
 * @property array|null $giftPet
 * @property array|null $businessAssignment
 * @property array|null $residueDetails
 * @property array|null $requestDetails
 * @property bool $appointGuardian
 * @property bool $hasMoreThanOneChildren
 * @property bool $sameGuardianAllChildren
 * @property array|null $children
 * @property array|null $reserveGuardian
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property int|null $payment_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Will newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Will newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Will query()
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereAddressSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereAppointGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereBusinessAssignment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereEachOtherExecutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereExecutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftCharity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftPet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereGiftProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereHasChildrenUnderEighteen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereHasMirrorWill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereHasMoreThanOneChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereHasPartner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereOwnProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereRequestDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereReserveExecutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereReserveGuardian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereResidueDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereSameGuardianAllChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereSecondApplicant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Will whereUserId($value)
 * @mixin \Eloquent
 */
class Will extends Model
{
    use HasFactory;

    const DRAFT = 'draft';
    const PENDING_PAYMENT = 'pending_payment';
    const COMPLETE = 'complete';

    protected $appends = [
        'fullName',
        'Address',
        'secondApplicantName',
        'secondApplicantAddress'
    ];

    protected $fillable = [
        'user_id', 'firstName', 'middleName', 'lastName', 'email', 'dob',
        'hasPartner', 'hasChildrenUnderEighteen', 'hasMirrorWill', 'ownProperty',
        'addressSummary', 'secondApplicant', 'eachOtherExecutor',
        'executor', 'reserveExecutor', 'giftOptions', 'giftMoney', 'giftCharity',
        'giftBank', 'giftProperty', 'giftPet', 'businessAssignment', 'residueDetails',
        'requestDetails', 'appointGuardian', 'hasMoreThanOneChildren', 'sameGuardianAllChildren',
        'children', 'reserveGuardian', 'wills', 'status', 'payment_id', 'step'
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
        'reserveGuardian' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAddressAttribute()
    {
        return $this->addressSummary['line1'] . ' ' . $this->addressSummary['line2'] . ' ' . $this->addressSummary['country'] . ' ' . $this->addressSummary['postal'];
    }

    public function getFullNameAttribute()
    {
        return $this->firstName . ' ' . $this->middleName . ' ' . $this->lastName;
    }

    public function getSecondApplicantNameAttribute()
    {
        if ($this->hasMirrorWill) {
            return $this->secondApplicant['firstName'] . ' ' . $this->secondApplicant['middleName'] . ' ' . $this->secondApplicant['lastName'];
        }
        return null;
    }

    public function getSecondApplicantAddressAttribute()
    {
        if ($this->hasMirrorWill) {
            return $this->secondApplicant['line1'] . ' ' . $this->secondApplicant['line2'] . ' ' . $this->secondApplicant['country'] . ' ' . $this->secondApplicant['postal'];
        }
        return null;
    }
}

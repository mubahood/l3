<?php

namespace App\Models\Elearning;

use App\Models\BaseModel;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use App\Models\Traits\Relationships\FarmerRelationship;
use App\Models\User;

class ELearningOutgoingCall extends BaseModel
{
    use Uuid;
    protected $fillable = [
        'callSessionState',
        'direction',
        'callerCountryCode',
        'durationInSeconds',
        'amount',
        'callerNumber',
        'destinationNumber',
        'callerCarrierName',
        'status',
        'sessionId',
        'callStartTime',
        'recordingUrl',
        'isActive',
        'currencyCode',

        'course_id',
        'student_id',
        'answered_at',
        'completed_at',
    ]; 
    
    public function student()
    {
        return $this->belongsTo(ELearningStudent::class, 'student_id');
    }


    /**
     * every time a model is created
     * automatically assign a UUID to it
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function (ELearningOutgoingCall $model) {
            $model->id = $model->generateUuid();
        });
    }

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
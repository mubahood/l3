<?php

namespace App\Models\Traits\Relationships;

use App\Models\Settings\keyword;

/**
 * Class LocationRelationship.
 */
trait QuestionFailureRelationship
{

    public function keyword()
    {
        return $this->belongsTo(keyword::class, 'keyword_id');
    }
}

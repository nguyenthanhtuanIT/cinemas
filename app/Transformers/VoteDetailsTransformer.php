<?php

namespace App\Transformers;

use App\Models\VoteDetails;

/**
 * Class VoteDetailsTransformer.
 *
 * @package namespace App\Transformers;
 */
class VoteDetailsTransformer extends BaseTransformer
{
    /**
     * Array attribute doesn't parse.
     */
    public $ignoreAttributes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform the custom field entity.
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        return [
            'user' => $model->getUser(),
            'film' => $model->getFilm(),
            'vote' => $model->getVote(),
        ];

    }
}

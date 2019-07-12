<?php

namespace App\Transformers;

use App\Models\Chair;

/**
 * Class ChairTransformer.
 *
 * @package namespace App\Transformers;
 */
class ChairTransformer extends BaseTransformer
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
            'vote_name' => $model->getVote(),
        ];
    }
}

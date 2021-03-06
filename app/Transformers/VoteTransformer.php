<?php

namespace App\Transformers;

use App\Models\Vote;

/**
 * Class VoteTransformer.
 *
 * @package namespace App\Transformers;
 */
class VoteTransformer extends BaseTransformer
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
            'lists' => $model->getFilms(),
            'cinema' => $model->inforRooms(),
            'user' => $model->getUser(),
        ];
    }

}

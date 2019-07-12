<?php

namespace App\Transformers;

use App\Models\Random;

/**
 * Class RandomTransformer.
 *
 * @package namespace App\Transformers;
 */
class RandomTransformer extends \App\Transformers\BaseTransformer
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
            'full_name' => $model->nameUser(),
        ];
    }
}

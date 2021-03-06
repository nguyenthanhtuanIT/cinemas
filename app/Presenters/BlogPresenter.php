<?php

namespace App\Presenters;

use App\Transformers\BlogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BlogPresenter.
 *
 * @package namespace App\Presenters;
 */
class BlogPresenter extends FractalPresenter
{
    protected $resourceKeyItem = 'Blog';
    protected $resourceKeyCollection = 'Blog';
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogTransformer();
    }
}

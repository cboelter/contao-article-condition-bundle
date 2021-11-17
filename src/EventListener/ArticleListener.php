<?php

namespace Boelter\ArticleConditionBundle\EventListener;

use Contao\ArticleModel;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Input;
use Contao\Model;

/**
 * Class ArticleListener
 * @package Boelter\ArticleConditionBundle\EventListener
 */
class ArticleListener
{
    /**
     * @var ContaoFrameworkInterface
     */
    protected $framework;

    /**
     * ArticleListener constructor.
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Check the visibility of the article based on the condition configuration.
     * @param Model $model
     * @return bool
     */
    public function onIsVisibleElement(Model $model, bool $visible): bool
    {
        if (!$model instanceof ArticleModel) {
            return $visible;
        }

        if (!$visible || !$model->articleConditionParameter) {
            return $visible;
        }

        if ($model->articleConditionParameter) {
            /** @var Adapter<Input> $inputAdapter */
            $inputAdapter = $this->framework->getAdapter(Input::class);
            $getParameter = $inputAdapter->get($model->articleConditionParameter);

            if (!$model->articleConditionInvert) {
                if (!$getParameter) {
                    return false;
                }
            } elseif ($model->articleConditionInvert) {
                if ($getParameter) {
                    return false;
                }
            }
        }

        return $visible;
    }
}

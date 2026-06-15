<?php

declare(strict_types=1);

namespace Boelter\ArticleConditionBundle\EventListener;

use Contao\ArticleModel;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Input;
use Contao\Model;

class ArticleListener
{
    private Adapter|Input $input;

    public function __construct(ContaoFramework $framework)
    {
        $this->input = $framework->getAdapter(Input::class);
    }

    #[AsHook('isVisibleElement')]
    public function onIsVisibleElement(Model $model, bool $visible): bool
    {
        if (! $model instanceof ArticleModel) {
            return $visible;
        }

        if (! $visible || ! $model->articleConditionParameter) {
            return $visible;
        }

        if ($model->articleConditionParameter) {
            $getParameter = $this->input->get($model->articleConditionParameter);

            if (! $model->articleConditionInvert) {
                if (! $getParameter) {
                    return false;
                }
            } elseif ($model->articleConditionInvert) {
                if ($getParameter) {
                    return false;
                }
            }
        }

        return true;
    }
}

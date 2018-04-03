<?php

namespace Boelter\ArticleConditionBundle\EventListener;

use Contao\ArticleModel;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Input;

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
     * @param ArticleModel $article
     * @return bool|void
     */
    public function onGetArticle(ArticleModel $article)
    {
        if (!$article->published || !$article->articleConditionParameter) {
            return;
        }

        if ($article->articleConditionParameter) {
            /** @var Input $inputAdapter */
            $inputAdapter = $this->framework->getAdapter(Input::class);
            $getParameter = $inputAdapter->get($article->articleConditionParameter);

            if (!$article->articleConditionInvert) {
                if (!$getParameter) {
                    return $article->published = false;
                }
            } elseif ($article->articleConditionInvert) {
                if ($getParameter) {
                    return $article->published = false;
                }
            }
        }
    }
}
<?php

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getArticle'][] = ['boelter.article.condition.getarticle', 'onGetArticle'];
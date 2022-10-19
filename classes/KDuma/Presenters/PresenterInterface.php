<?php


namespace KDuma\Presenters;


/**
 * Interface PresenterInterface
 * @package KDuma\Presenters
 */
interface PresenterInterface
{
    public function exec(array $results, array $pairs, array $list, int $max_len):mixed;
}
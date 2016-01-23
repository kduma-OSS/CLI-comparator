<?php


namespace KDuma\Presenters;


/**
 * Interface PresenterInterface
 * @package KDuma\Presenters
 */
interface PresenterInterface
{
    /**
     * @param $results
     * @param $pairs
     * @param $list
     * @param $max_len
     * @return mixed
     */
    public function exec($results, $pairs, $list, $max_len);
}
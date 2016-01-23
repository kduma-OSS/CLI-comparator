<?php


namespace KDuma\Presenters;


interface PresenterInterface
{
    public function exec($results, $pairs, $list, $max_len);
}
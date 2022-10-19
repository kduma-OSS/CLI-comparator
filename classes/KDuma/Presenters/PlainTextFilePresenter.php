<?php


namespace KDuma\Presenters;


/**
 * Class PlainTextFilePresenter
 * @package KDuma\Presenters
 */
class PlainTextFilePresenter extends PlainTextPresenter
{
    public function __construct(public string $file_name)
    { }

    public function exec(array $results, array $pairs, array $list, int $max_len): string
    {
        file_put_contents($this->file_name, parent::exec($results, $pairs, $list, $max_len));
        return "Output saved to {$this->file_name} file.";
    }
}
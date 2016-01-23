<?php


namespace KDuma\Presenters;


/**
 * Class PlainTextFilePresenter
 * @package KDuma\Presenters
 */
/**
 * Class PlainTextFilePresenter
 * @package KDuma\Presenters
 */
class PlainTextFilePresenter extends PlainTextPresenter
{
    /**
     * @var
     */
    public $file_name;

    /**
     * PlainTextFilePresenter constructor.
     * @param $file_name
     */
    public function __construct($file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * @param $results
     * @param $pary
     * @param $list
     * @param $max_len
     * @return string
     */
    public function exec($results, $pary, $list, $max_len)
    {
        file_put_contents($this->file_name, parent::exec($results, $pary, $list, $max_len));
        return "Output saved to {$this->file_name} file.";
    }
}
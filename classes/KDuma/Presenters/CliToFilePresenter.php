<?php


namespace KDuma\Presenters;


class CliToFilePresenter extends CliPresenter
{
    /**
     * @var
     */
    public $file_name;

    /**
     * CliToFilePresenter constructor.
     * @param \League\CLImate\CLImate $climate
     * @param $file_name
     */
    public function __construct($climate, $file_name)
    {
        parent::__construct($climate);
        $this->file_name = $file_name;
    }


    public function exec($results, $pary, $list, $max_len)
    {
        $this->climate->output->defaultTo('buffer');

        parent::exec($results, $pary, $list, $max_len);

        file_put_contents($this->file_name, $this->climate->output->get('buffer')->get());

        $this->climate->output->get('buffer')->clean();

        $this->climate->output->defaultTo('out');

        return "Output saved to {$this->file_name} file.";
    }
}
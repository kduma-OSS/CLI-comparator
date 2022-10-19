<?php


namespace KDuma\Presenters;


use Exception;
use League\CLImate\CLImate;

/**
 * Class CliToFilePresenter
 * @package KDuma\Presenters
 */
class CliToFilePresenter extends CliPresenter
{
    public function __construct(CLImate $climate, public string $file_name)
    {
        parent::__construct($climate);
    }

    /**
     * @throws Exception
     */
    public function exec(array $results, array $pairs, array $list, int $max_len): string
    {
        $this->climate->output->defaultTo('buffer');

        parent::exec($results, $pairs, $list, $max_len);

        file_put_contents($this->file_name, $this->climate->output->get('buffer')->get());

        $this->climate->output->get('buffer')->clean();

        $this->climate->output->defaultTo('out');

        return "Output saved to {$this->file_name} file.";
    }
}
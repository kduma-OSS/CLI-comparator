<?php


namespace KDuma\Presenters;


use League\CLImate\CLImate;

/**
 * Class CliPresenter
 * @package KDuma\Presenters
 */
class CliPresenter implements PresenterInterface
{
    public function __construct(protected CLImate $climate)
    { }
    
    public function exec(array $results, array $pairs, array $list, int $max_len): mixed
    {
        $output = [];

        foreach ($results as $result_list) {
            foreach ($result_list as $result) {
                $output[] = [
                    'similarity' => number_format($result['similarity'], 2).'%',
                    'difference' => number_format($result['difference'], 2).'%',
                    'Side A' => $result['a'],
                    'Side B' => $result['b'],
                ];
            }
        }

        if (count($output) > 0) {
            $this->climate->table($output);
        } else {
            $this->climate->out('No results found');
        }
        
        return null;
    }
}
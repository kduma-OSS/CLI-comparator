<?php


namespace KDuma\Presenters;


class CliPresenter implements PresenterInterface
{
    /**
     * @var \League\CLImate\CLImate
     */
    protected $climate;

    /**
     * CliPresenter constructor.
     * @param \League\CLImate\CLImate $climate
     */
    public function __construct($climate)
    {
        $this->climate = $climate;
    }


    public function exec($results, $pary, $list, $max_len)
    {
        $output = [];

        foreach ($results as $precentage => $result_list) {
            foreach ($result_list as $id => $result) {
                $output[] = [
                    'simlarity' => number_format($result['simlarity'], 2).'%',
                    'difference' => number_format($result['difference'], 2).'%',
                    'Side A' => $result['a'],
                    'Side B' => $result['b'],
                ];
            }
        }

        $this->climate->table($output);
    }
}
<?php


namespace KDuma\Presenters;


/**
 * Class PlainTextPresenter
 * @package KDuma\Presenters
 */
class PlainTextPresenter implements PresenterInterface
{
    public function exec(array $results, array $pairs, array $list, int $max_len): string
    {
        $output = [];

        foreach ($results as $percentage => $result_list) {
            $output[] = '';
            $output[] = sprintf("%s", str_pad(' ' . $percentage . '% ', $max_len * 2 + 21, '=', STR_PAD_BOTH));
            foreach ($result_list as $id => $label) {
                $id = $pairs[$id];

                $a = str_pad(trim($list[$id[0]]), $max_len, ' ', STR_PAD_RIGHT);
                $b = str_pad(trim($list[$id[1]]), $max_len, ' ', STR_PAD_LEFT);

                $output[] = sprintf("%s podobna w %5s%% do %s", $a, $percentage, $b);
            }
        }

        return implode("\n", $output);
    }
}
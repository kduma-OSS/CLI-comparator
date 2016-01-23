<?php


namespace KDuma\Presenters;


/**
 * Class PlainTextPresenter
 * @package KDuma\Presenters
 */
class PlainTextPresenter implements PresenterInterface
{
    /**
     * @param $results
     * @param $pary
     * @param $list
     * @param $max_len
     * @return string
     */
    public function exec($results, $pary, $list, $max_len)
    {
        $output = [];

        foreach ($results as $precentage => $result_list) {
            $output[] = '';
            $output[] = sprintf("%s", str_pad(' ' . $precentage . '% ', $max_len * 2 + 21, '=', STR_PAD_BOTH));
            foreach ($result_list as $id => $label) {
                $id = $pary[$id];

                $a = str_pad(trim($list[$id[0]]), $max_len, ' ', STR_PAD_RIGHT);
                $b = str_pad(trim($list[$id[1]]), $max_len, ' ', STR_PAD_LEFT);

                $output[] = sprintf("%s podobna w %5s%% do %s", $a, $precentage, $b);
            }
        }

        return implode("\n", $output);
    }
}
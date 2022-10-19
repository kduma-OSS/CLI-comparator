<?php
namespace KDuma;

use Exception;
use KDuma\Presenters\PresenterInterface;
use StringCompare;

/**
 * Class Comparator
 * @package KDuma
 */
class Comparator
{
    protected ?string $path = null;
    protected ?string $file = null;
    protected ?string $compare_to = null;
    protected int $max_len    = 0;

    /**
     * @throws Exception
     */
    function exec(PresenterInterface $presenter)
    {
        $list = $this->getList();
        $pairs = $this->getPairs($list);
        $results = $this->getResults($pairs, $list);

        return $presenter->exec($results, $pairs, $list, $this->max_len);
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        if ($path == '')
            $this->path = null;
        else
            $this->path = substr($path, -1) == DIRECTORY_SEPARATOR
                ? $path
                : $path . DIRECTORY_SEPARATOR;;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }
    
    public function setFile(?string $file): void
    {
        if ($file == '')
            $this->file = null;
        else
            $this->file = substr($file, 0, 1) == DIRECTORY_SEPARATOR
                ? $file
                : DIRECTORY_SEPARATOR . $file;
    }
    
    protected function getList(): array
    {
        $this->max_len = 0;

        $list = glob($this->path . '*');
        $list = array_map(function ($path) {
            if (!is_dir($path) && !is_null($this->file) || is_dir($path) && is_null($this->file))
                return null;

            $this->max_len = max([$this->max_len, strlen(basename($path))]);
            
            return basename($path);
        }, $list);
        
        $list = array_filter($list, function ($path) {
            return !is_null($path);
        });
        
        return array_filter($list, function ($path) {
            if (is_null($this->file)) {
                return file_exists($this->path . $path);
            } else {
                $file_exists = file_exists($this->path . $path . $this->file);
                
                if (!$file_exists)
                    throw new Exception('file ' . $path . $this->file . ' doesn\'t exists!');
                
                return true;
            }
        });
    }

    /**
     * @throws Exception
     */
    public function setCompareTo(?string $compare_to): void
    {
        if ($compare_to == '')
            $this->compare_to = null;
        else {
            $found = array_search($compare_to, $this->getList());

            if ($found == false) {
                throw new Exception('Provided compare to entry doesn\'t exist!');
            }

            $this->compare_to = $found;
        }
    }

    protected function getPairs(array $list): array
    {
        $pairs = [];

        foreach ($list as $key_a => $value_a) {
            foreach ($list as $key_b => $value_b) {
                if ($key_a == $key_b)
                    continue;

                if (!is_null($this->compare_to)) {

                    if ($key_a != $this->compare_to)
                        continue;
                }

                $tmp = [$key_a, $key_b];
                sort($tmp);
                $pairs[implode('-', $tmp)] = $tmp;
            }
        }
        return $pairs;
    }

    /**
     * @throws Exception
     */
    protected function getResults(array $pairs, array $list): array
    {
        $results = [];

        foreach ($pairs as $key => $value) {
            if (is_null($this->file)) {

                $a = file_get_contents($this->path . $list[$value[0]]);
                if (strlen(trim($a)) == 0)
                    throw new Exception('File ' . $list[$value[0]] . ' is empty!');

                $b = file_get_contents($this->path . $list[$value[1]]);
                if (strlen(trim($b)) == 0)
                    throw new Exception('File ' . $list[$value[1]] . ' is empty!');
            } else {
                $a = file_get_contents($this->path . $list[$value[0]] . $this->file);
                if (strlen(trim($a)) == 0)
                    throw new Exception('File ' . $list[$value[0]] . $this->file . ' is empty!');

                $b = file_get_contents($this->path . $list[$value[1]] . $this->file);
                if (strlen(trim($b)) == 0)
                    throw new Exception('File ' . $list[$value[1]] . $this->file . ' is empty!');
            }

            $phpStringCompare = new StringCompare($a, $b);
            $similarity = $phpStringCompare->getSimilarityPercentage();
            $difference = $phpStringCompare->getDifferencePercentage();


            $results[(string)round($similarity, 2)][$key] = [
                'a' => $list[$value[0]],
                'b' => $list[$value[1]],
                'similarity' => $similarity,
                'difference' => $difference
            ];

        }
        krsort($results);
        return $results;
    }

}
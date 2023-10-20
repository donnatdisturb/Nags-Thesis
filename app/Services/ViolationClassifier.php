<?php
namespace App\Services;

use Phpml\Classification\KNearestNeighbors;
use Phpml\CrossValidation\StratifiedRandomSplit;

class ViolationClassifier
{
    protected $classifier;
    protected $uniqueTargets;


    public function __construct()
    {
        $this->classifier = new KNearestNeighbors();
        $this->uniqueTargets = [];
    
    }

    public function train(array $X, array $y)
    {
        $bagOfWordsPerSample = $this->convertToBagOfWords($X);

        // Ensure that $X and $y have the same number of samples
        if (count($bagOfWordsPerSample) !== count($y)) {
            throw new \InvalidArgumentException('Number of samples in $X and $y must be the same.');
        }
       
        $this->uniqueTargets = array_unique($y);

        // Split the dataset into training and testing sets
        $dataset = new \Phpml\Dataset\ArrayDataset($bagOfWordsPerSample, $y);
        //dd($dataset);
        $split = new StratifiedRandomSplit($dataset, 0.3);
       // dd($split);
        $this->classifier->train($split->getTrainSamples(), $split->getTrainLabels());
      

    }

    public function predict(string $text)
    {
        $bagOfWords = $this->convertToBagOfWords([$text]);
        //dd($bagOfWords);
        // Make the prediction
        if (empty($bagOfWords)) {
            throw new \InvalidArgumentException('Bag-of-words representation is empty.');
        }

         $numericalArray = $bagOfWords[0];
         //dd($numericalArray);
    
        $prediction = $this->classifier->predict($numericalArray);
       //dd($prediction);
        //$prediction = $this->classifier->predict($bagOfWords[0]);
        return $prediction;

     
    }
    

    protected function convertToBagOfWords(array $samples): array
    {
        // $bagOfWords = [];
        // foreach ($samples as $sample) {
        //     $tokens = preg_split('/\s+/', strtolower($sample), -1, PREG_SPLIT_NO_EMPTY);
        //     $counts = array_count_values($tokens);
        //     $bagOfWords[] = array_values($counts); // Convert to numerical array
        // }
        // return $bagOfWords;
        $bagOfWords = [];
        foreach ($samples as $sample) {
            $tokens = preg_split('/\s+/', strtolower($sample), -1, PREG_SPLIT_NO_EMPTY);
            $counts = array_count_values($tokens);
            $bagOfWords[] = array_values($counts); 
        }
        //dd($bagOfWords);
        return $bagOfWords;

    }

    protected function mergeBagOfWords(array $bagOfWordsPerSample): array
    {
        $mergedBagOfWords = [];
        foreach ($bagOfWordsPerSample as $bagOfWords) {
            foreach ($bagOfWords as $word => $count) {
                if (!isset($mergedBagOfWords[$word])) {
                    $mergedBagOfWords[$word] = $count;
                } else {
                    $mergedBagOfWords[$word] += $count;
                }
            }
        }
        return [$mergedBagOfWords];
    }

    public function getUniqueTargets()
    {
        return $this->uniqueTargets;
    }

    public function resetClassifier()
    {
        $this->classifier = new KNearestNeighbors();
    }
}

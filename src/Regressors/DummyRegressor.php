<?php

namespace Rubix\ML\Regressors;

use Rubix\ML\Persistable;
use Rubix\ML\Datasets\Dataset;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Other\Strategies\Continuous;
use Rubix\ML\Other\Strategies\BlurryMean;
use InvalidArgumentException;

class DummyRegressor implements Regressor, Persistable
{
    /**
     * The guessing strategy that the dummy employs.
     *
     * @var \Rubix\ML\Other\Strategies\Continuous
     */
    protected $strategy;

    /**
     * @param  \Rubix\ML\Other\Strategies\Continuous  $strategy
     * @return void
     */
    public function __construct(Continuous $strategy = null)
    {
        if (!isset($strategy)) {
            $strategy = new BlurryMean();
        }

        $this->strategy = $strategy;
    }

    /**
     * Fit the training set to the given guessing strategy.
     *
     * @param  \Rubix\ML\Datasets\Labeled  $dataset
     * @throws \InvalidArgumentException
     * @return void
     */
    public function train(Dataset $dataset) : void
    {
        if (!$dataset instanceof Labeled) {
            throw new InvalidArgumentException('This Estimator requires a'
                . ' Labeled training set.');
        }

        $this->strategy->fit($dataset->labels());
    }

    /**
     * Make a prediction of a given sample dataset.
     *
     * @param  \Rubix\ML\Datasets\Dataset  $dataset
     * @return array
     */
    public function predict(Dataset $dataset) : array
    {
        $predictions = [];

        foreach ($dataset as $sample) {
            $predictions[] = $this->strategy->guess();
        }

        return $predictions;
    }
}

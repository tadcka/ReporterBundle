<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Tadcka\ReporterBundle\Model\TrackerInterface;
use Tadcka\ReporterBundle\Provider\ProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 23.01
 */
class TrackerChoiceDataTransformer implements DataTransformerInterface
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * Constructor.
     *
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Transform.
     *
     * @param TrackerInterface $value
     *
     * @return null|int
     */
    public function transform($value)
    {
        if (null !== $value) {
            $value = $value->getId();
        }

        return $value;
    }

    /**
     * Reverse transform.
     *
     * @param null|int $value
     *
     * @return null|TrackerInterface
     */
    public function reverseTransform($value)
    {
        if (null !== $value) {
            $value = $this->provider->getTracker($value);
        }

        return $value;
    }
}

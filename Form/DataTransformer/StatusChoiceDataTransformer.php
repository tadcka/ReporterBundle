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
use Tadcka\ReporterBundle\Model\StatusInterface;
use Tadcka\ReporterBundle\Provider\StatusProviderInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 14.2.1 23.01
 */
class StatusChoiceDataTransformer implements DataTransformerInterface
{
    /**
     * @var StatusProviderInterface
     */
    private $statusProvider;

    /**
     * Constructor.
     *
     * @param StatusProviderInterface $statusProvider
     */
    public function __construct(StatusProviderInterface $statusProvider)
    {
        $this->statusProvider = $statusProvider;
    }

    /**
     * Transform.
     *
     * @param StatusInterface $value
     *
     * @return null|int
     */
    public function transform($value)
    {
        if (null !== $value) {
            return $value->getId();
        }

        return null;
    }

    /**
     * Reverse transform.
     *
     * @param null|int $value
     *
     * @return null|StatusInterface
     */
    public function reverseTransform($value)
    {
        if (null !== $value) {
            return $this->statusProvider->getStatus($value);
        }

        return null;
    }
}

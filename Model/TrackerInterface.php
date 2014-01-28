<?php
/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Model;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.lt>
 *
 * @since 1/28/14 12:04 AM
 */
interface TrackerInterface 
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set $updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return TrackerInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set translation.
     *
     * @param array|TrackerTranslationInterface[] $translations
     *
     * @return TrackerInterface
     */
    public function setTranslations($translations);

    /**
     * Get translations.
     *
     * @return array|TrackerTranslationInterface[]
     */
    public function getTranslations();

    /**
     * Add translation.
     *
     * @param TrackerTranslationInterface $translation
     */
    public function addTranslation(TrackerTranslationInterface $translation);

    /**
     * Remove translation.
     *
     * @param TrackerTranslationInterface $translation
     */
    public function removeTranslation(TrackerTranslationInterface $translation);

    /**
     * Get translation.
     *
     * @param string $locale
     *
     * @return null|TrackerTranslationInterface
     */
    public function getTranslation($locale);
}

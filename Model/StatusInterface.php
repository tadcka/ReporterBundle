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
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 1/28/14 12:04 AM
 */
interface StatusInterface 
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
     * @return StatusInterface
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
     * @param array|StatusTranslationInterface[] $translations
     *
     * @return StatusInterface
     */
    public function setTranslations($translations);

    /**
     * Get translations.
     *
     * @return array|StatusTranslationInterface[]
     */
    public function getTranslations();

    /**
     * Add translation.
     *
     * @param StatusTranslationInterface $translation
     */
    public function addTranslation(StatusTranslationInterface $translation);

    /**
     * Remove translation.
     *
     * @param StatusTranslationInterface $translation
     */
    public function removeTranslation(StatusTranslationInterface $translation);

    /**
     * Get translation.
     *
     * @param string $locale
     *
     * @return null|StatusTranslationInterface
     */
    public function getTranslation($locale);
}

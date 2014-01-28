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
 * @since 1/28/14 12:42 AM
 */
interface TrackerTranslationInterface 
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return TrackerTranslationInterface
     */
    public function setDescription($description);

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set lang.
     *
     * @param string $lang
     *
     * @return TrackerTranslationInterface
     */
    public function setLang($lang);

    /**
     * Get lang.
     *
     * @return string
     */
    public function getLang();

    /**
     * Set tracker.
     *
     * @param TrackerInterface $tracker
     *
     * @return TrackerTranslationInterface
     */
    public function setTracker(TrackerInterface $tracker);

    /**
     * Get tracker.
     *
     * @return TrackerInterface
     */
    public function getTracker();

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return TrackerTranslationInterface
     */
    public function setTitle($title);

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();
}

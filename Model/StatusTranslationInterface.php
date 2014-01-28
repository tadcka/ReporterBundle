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
 * @since 1/28/14 12:19 AM
 */
interface StatusTranslationInterface 
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
     * @return StatusTranslationInterface
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
     * @return StatusTranslationInterface
     */
    public function setLang($lang);

    /**
     * Get lang.
     *
     * @return string
     */
    public function getLang();

    /**
     * Set status.
     *
     * @param StatusInterface $status
     *
     * @return StatusTranslationInterface
     */
    public function setStatus(StatusInterface $status);

    /**
     * Get status.
     *
     * @return StatusInterface
     */
    public function getStatus();

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return StatusTranslationInterface
     */
    public function setTitle($title);

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();
}

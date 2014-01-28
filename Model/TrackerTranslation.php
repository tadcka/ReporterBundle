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
 * @since 1/28/14 12:41 AM
 */
abstract class TrackerTranslation implements TrackerTranslationInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TrackerInterface
     */
    protected $tracker;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * {@inheritdoc}
     */
    public function setTracker(TrackerInterface $tracker)
    {
        $this->tracker = $tracker;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }
}

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
 * @since 1/27/14 11:59 PM
 */
abstract class Report implements ReportInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $reporterEmail;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var TrackerInterface
     */
    protected $tracker;

    /**
     * @var StatusInterface
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $metaInfo;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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
    public function setMetaInfo($metaInfo)
    {
        $this->metaInfo = $metaInfo;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaInfo()
    {
        return $this->metaInfo;
    }

    /**
     * {@inheritdoc}
     */
    public function setReporterEmail($reporterEmail)
    {
        $this->reporterEmail = $reporterEmail;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReporterEmail()
    {
        return $this->reporterEmail;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus(StatusInterface $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
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
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

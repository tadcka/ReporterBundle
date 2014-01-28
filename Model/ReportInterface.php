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
 * @since 1/28/14 12:06 AM
 */
interface ReportInterface 
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get createAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return ReportInterface
     */
    public function setDescription($description);

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set metaInfo.
     *
     * @param string $metaInfo
     *
     * @return ReportInterface
     */
    public function setMetaInfo($metaInfo);

    /**
     * Get metaInfo.
     *
     * @return string
     */
    public function getMetaInfo();

    /**
     * Set reporterEmail.
     *
     * @param string $reporterEmail
     *
     * @return ReportInterface
     */
    public function setReporterEmail($reporterEmail);

    /**
     * Get reporterEmail.
     *
     * @return string
     */
    public function getReporterEmail();

    /**
     * Set status.
     *
     * @param StatusInterface $status
     *
     * @return ReportInterface
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
     * @return ReportInterface
     */
    public function setTitle($title);

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set tracker.
     *
     * @param TrackerInterface $tracker
     *
     * @return ReportInterface
     */
    public function setTracker(TrackerInterface $tracker);

    /**
     * Get tracker.
     *
     * @return TrackerInterface
     */
    public function getTracker();

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return ReportInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}

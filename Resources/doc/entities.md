Entities
==========

## Report

``` php
/**
 * Class Report
 *
 * @package Tadcka\SandboxBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="tadcka_report")
 */
class Report extends BaseReport
{
    /**
     * @var TrackerInterface
     *
     * @ORM\ManyToOne(targetEntity="Tadcka\SandboxBundle\Entity\Tracker")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="tracker_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    protected $tracker;

    /**
     * @var StatusInterface
     *
     * @ORM\ManyToOne(targetEntity="Tadcka\SandboxBundle\Entity\Status")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    protected $status;
}
```

## Status

``` php
/**
 * Class Status
 *
 * @package Tadcka\SandboxBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="tadcka_status")
 */
class Status extends BaseStatus
{
    /**
     * @var StatusTranslationInterface[]
     *
     * @ORM\OneToMany(targetEntity="Tadcka\SandboxBundle\Entity\StatusTranslation", mappedBy="status", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addTranslation(StatusTranslationInterface $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTranslation(StatusTranslationInterface $translation)
    {
        $this->translations->removeElement($translation);
    }
}
```

## StatusTranslation

``` php
/**
 * Class StatusTranslation
 *
 * @package Tadcka\SandboxBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="tadcka_status_translation",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_lang_idx", columns={"status_id", "lang"})
 *      }
 * )
 */
class StatusTranslation extends BaseStatusTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="Tadcka\SandboxBundle\Entity\Status", inversedBy="translations")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    protected $status;
}
```

## Tracker

``` php
/**
 * Class Tracker
 *
 * @package Tadcka\SandboxBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="tadcka_tracker")
 */
class Tracker extends BaseTracker
{
    /**
     * @var TrackerTranslationInterface[]
     *
     * @ORM\OneToMany(targetEntity="Tadcka\SandboxBundle\Entity\TrackerTranslation", mappedBy="tracker", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addTranslation(TrackerTranslationInterface $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTranslation(TrackerTranslationInterface $translation)
    {
        $this->translations->removeElement($translation);
    }
}
```

## TrackerTranslation

``` php
/**
 * Class TrackerTranslation
 *
 * @package Tadcka\SandboxBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="tadcka_tracker_translation",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_lang_idx", columns={"tracker_id", "lang"})
 *      }
 * )
 */
class TrackerTranslation extends BaseTrackerTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="Tadcka\SandboxBundle\Entity\Tracker", inversedBy="translations")
     * @ORM\JoinColumn(name="tracker_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    protected $tracker;
}
```

<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\Message;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 3/20/14 10:49 PM
 */
class FlashMessage implements FlashMessageInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Constructor.
     *
     * @param Session $session
     * @param TranslatorInterface $translator
     */
    public function __construct(Session $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function onSuccess($id, array $parameters = array(), $domain = 'TadckaReporterBundle')
    {
        $this->session->getFlashBag()
            ->set(
                'flash_notices',
                array(
                    'success' => array($this->translator->trans($id, $parameters, $domain))
                )
            );
    }
}

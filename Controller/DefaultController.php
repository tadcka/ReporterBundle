<?php

namespace Tadcka\ReporterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TadckaReporterBundle:Default:index.html.twig', array('name' => $name));
    }
}

<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace yo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this
						->get('templating')
						->render('yoPlatformBundle:Advert:index.html.twig', array(
							'nom' => 'yoyo'
						)
					);
	return new Response($content);
    }
}
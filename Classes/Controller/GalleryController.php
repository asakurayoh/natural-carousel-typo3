<?php
namespace Fab\CarouselGallery\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Fab\CarouselGallery\Persistence\MatcherFactory;
use Fab\CarouselGallery\Persistence\OrderFactory;
use Fab\Vidi\Domain\Repository\ContentRepositoryFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller
 */
class GalleryController extends ActionController
{

    /**
    /**
     * @var array
     */
    protected $configuration = array();

    /**
     * @var array
     */
    protected $settings = array();

    /**
     * @return void
     */
    public function listAction()
    {

        // Initialize some objects related to the query.
        $matcher = MatcherFactory::getInstance($this->settings)->getMatcher();
        $order = OrderFactory::getInstance($this->settings)->getOrder();

        // Fetch the adequate repository for a known data type.
        $contentRepository = ContentRepositoryFactory::getInstance('sys_file');

        // Fetch and count files
        $images = $contentRepository->findBy($matcher, $order);

        // Assign template variables
        $this->view->assign('settings', $this->settings);
        $this->view->assign('data', $this->configurationManager->getcontentObject()->data);
        $this->view->assign('images', $images);

    }

}

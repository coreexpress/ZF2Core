<?php
namespace CoreInfo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $debug['PATH_APPLICATION'] = PATH_APPLICATION;
        $debug['PATH_PUBLIC'] = PATH_PUBLIC;
        $debug['PATH_MEDIA'] = PATH_MEDIA;
        $debug['PATH_TEMPLATE'] = PATH_TEMPLATE;
        $debug['PATH_DATA'] = PATH_DATA;
        
        \Zend\Debug\Debug::dump($debug);
        
        return new ViewModel();
    }
    
}

<?php

namespace DW\CacheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DW\CacheBundle\Services\RedisService;

/**
 * Classe par defaut du bundle
 */
class DefaultController extends Controller
{

  /**
   * Controleur d'entree
   *
   * @return twig Template
   */
  public function indexAction()
  {
    $redisService = new RedisService();

//    $redisService->setValToCache('test4', "val 4");
//    $redisService->setValToCacheReplicate('test4', "val 4");

    $exist = $redisService->isExistInCache('test4');

    var_dump($exist); die;

//    $redisService->setValToCache('test5', 'value5');
//    $redisService->setValToCacheReplicate('test5', 'value5');
//
//    var_dump($redisService->getValFromCache('test5'));
//    $redisService->getValFromCache('test');
//
//    var_dump($redisService->getValFromCache('test'));
    return $this->render('DWCacheBundle:Default:index.html.twig');
  }

}

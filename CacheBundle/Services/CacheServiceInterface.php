<?php

namespace DW\CacheBundle\Services;

/**
 * Interface des caches
 */
interface CacheServiceInterface
{
  /**
   * Connexion
   */
  public function getConnection();

  /**
   * Permet de mettre une valeur en cache
   * @param string $key         La clef
   * @param string $value       La valeur
   * @param int    $timeToCache Temps de mise en cache en secondes
   */
  public function setValToCache($key, $value, $timeToCache = 0);

  /**
   * Permet de mettre un objet en cache
   * @param string $key         La clef
   * @param Object $value       L'objet
   * @param int    $timeToCache Temps de mise en cache en secondes
   */
  public function setObjToCache($key, $value, $timeToCache = 0);

  /**
   * Permet de supprimer une valeur
   * @param type $key
   */
  public function delInCache($key);

  /**
   * Recupere une valeur mise en cache
   * @param string $key La clef
   */
  public function getValFromCache($key);

  /**
   * Recupere un objet depuis le cache
   * @param string $key La clef
   */
  public function getObjFromCache($key);

  /**
   * Verifie l'exisatnce d'une valeur en cache
   * @param string $key La clef
   */
  public function isExistInCache($key);
}

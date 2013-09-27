<?php

/**
 * @author yann-eric@live.fr
 */

namespace DW\CacheBundle\Services;

use DW\CacheBundle\Services\CacheServiceInterface;

/**
 * Classe de manipulation du cache Apc
 */
class ApcService implements CacheServiceInterface
{

  /**
   * Supprime l'entree en cache
   * @param string $key La clef
   *
   * @return True si la valeur a bien ete supprimee
   */
  public function delInCache($key)
  {
    return apc_delete($key);
  }

  /**
   * Fonction non utilisee pour apc
   */
  public function getConnection()
  {

  }

  /**
   * Recupere un objet en cache
   * @param string $key La clef
   *
   * @return Object Un objet
   */
  public function getObjFromCache($key)
  {
    return unserialize(apc_fetch($key));
  }

  /**
   * Retourne une valeur en cache
   * @param string $key La clef
   *
   * @return string La valeur
   */
  public function getValFromCache($key)
  {
    return apc_fetch($key);
  }

  /**
   * Verifie l'existance d'une clef en cache
   * @param string $key La clef
   *
   * @return boolean True si la clef existe dans le cache
   */
  public function isExistInCache($key)
  {
    return apc_exists($key);
  }

  /**
   * Ecrit dans le cache Apc
   * @param string $key         La clef dans Apc
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setObjToCache($key, $value, $timeToCache = 0)
  {
    apc_add($key, serialize($value), $timeToCache);
  }

  /**
   * Ecrit dans le cache aPC
   * @param string $key         La clef dans Apc
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setValToCache($key, $value, $timeToCache = 0)
  {
    apc_add($key, $value, $timeToCache);
  }
}

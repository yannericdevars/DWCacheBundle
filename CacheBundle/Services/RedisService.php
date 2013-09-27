<?php

/**
 * @author yann-eric@live.fr
 */
 
namespace DW\CacheBundle\Services;

use DW\CacheBundle\Services\CacheServiceInterface;
use Redis;

/**
 * Classe de manipulation de Redis
 */
class RedisService implements CacheServiceInterface
{

  /**
   * Permet de se connecter a redis
   *
   * @return \Redis Une connexion redis
   */
  public function getConnection()
  {
    $redis = new Redis();

    $paramValueServer = 'virtual1.com'; // Mettre valeur en configuration
    $paramValuePort = 6379;             // Mettre valeur en configuration

    $redis->connect($paramValueServer, $paramValuePort);

    $redis->select(5);                  // Mettre valeur en configuration

    return $redis;
  }

  /**
   * Permet de se connecter a redis
   *
   * @return \Redis Une connexion redis
   */
  public function getConnectionReplicate()
  {
    $redis = new Redis();

    $paramValueServer = 'virtual1.com'; // Mettre valeur en configuration
    $paramValuePort = 6379;             // Mettre valeur en configuration

    $redis->connect($paramValueServer, $paramValuePort);

    $redis->select(4);                  // Mettre valeur en configuration

    return $redis;
  }

  /**
   * Ecrit dans le cache Redis
   * @param string $key         La clef dans Redis
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setValToCache($key, $value, $timeToCache = 0)
  {
    $redis = $this->getConnection();

    if (isset($redis->socket)) {
      $redis->set($key, $value, $timeToCache);
    } else {
      $redisReplicate = $this->getConnectionReplicate();
      $redisReplicate->set($key, $value, $timeToCache);
    }
  }

  /**
   * Ecrit dans le cache Redis
   * @param string $key         La clef dans Redis
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setValToCacheReplicate($key, $value, $timeToCache = 0)
  {
    $redis = $this->getConnectionReplicate();

    $redis->set($key, $value, $timeToCache);
  }

  /**
   * Ecrit dans le cache Redis
   * @param string $key         La clef dans Redis
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setObjToCache($key, $value, $timeToCache = 0)
  {
    $redis = $this->getConnection();

    $redis->set($key, serialize($value), $timeToCache);
  }

  /**
   * Ecrit dans le cache Redis
   * @param string $key         La clef dans Redis
   * @param string $value       La valeur a stocker
   * @param string $timeToCache Temps de la mise en cache
   */
  public function setObjToCacheReplicate($key, $value, $timeToCache = 0)
  {
    $redis = $this->getConnectionReplicate();


    $redis->set($key, serialize($value), $timeToCache);
  }

  /**
   * Supprime une valeur dans redis selon sa clef
   * @param string $key La clef dans Redis
   */
  public function delInCache($key)
  {

    $redis = $this->getConnection();

    if (isset($redis->socket)) {
      $redis->del($key);
    }

    $redisReplicate = $this->getConnectionReplicate();

    if (isset($redisReplicate->socket)) {
      $redisReplicate->del($key);
    }
  }

  /**
   * Recupere une valeur dans redis garce a la clef
   * @param string $key La clef dans redis
   *
   * @return string La valeur
   */
  public function getValFromCache($key)
  {
    $redis = $this->getConnection();

    if (isset($redis->socket)) {
      return $redis->get($key);
    } else {
      $redisReplicate = $this->getConnectionReplicate();

      return $redisReplicate->get($key);
    }
  }

  /**
   * Recupere une valeur dans redis grace a la clef
   * @param string $key La clef dans redis
   *
   * @return string La valeur
   */
  public function getObjFromCache($key)
  {
    $redis = $this->getConnection();

    if (isset($redis->socket)) {
      return unserialize($redis->get($key));
    } else {
      $redisReplicate = $this->getConnectionReplicate();

      return unserialize($redisReplicate->get($key));
    }
  }

  /**
   * Verifie l'existance d'une valeur dans redis
   * @param string $key La clef
   *
   * @return boolean True si l'a valeur existe'entree existe selon la clef renseignee
   */
  public function isExistInCache($key)
  {
    $return = true;
    $redis = $this->getConnection();

    if (isset($redis->socket)) {
      $result = $redis->get($key);

      if ($result === false) {
        $return = false;
      }

      return $return;
    } else {
      $redisReplicate = $this->getConnectionReplicate();
      $result = $redisReplicate->get($key);

      if ($result === false) {
        $return = false;
      }

      return $return;
    }
  }

}

<?php

namespace Onwwward\Textmagic;

use ReflectionClass;
use Textmagic\Services\TextmagicRestClient;

class Textmagic
{
  /**
   * Textmagic client instance.
   * 
   * @var \Textmagic\Services\TextmagicRestClient
   */
  protected $client;

  public function __construct($config)
  {
    $this->client = (new ReflectionClass(TextmagicRestClient::class))->newInstanceArgs($config);
  }

  /**
   * Return the client variable
   * 
   * @return \Textmagic\Services\TextmagicRestClient
   */
  public function client()
  {
    return $this->client;
  }

  /**
   * Calla fucntion on the client instance in order to catch and log any errors.
   * 
   * @param  name $resource [description]
   * @param  name $action   [description]
   * @param  array  $params   [description]
   * @return mixed 
   */
  public function trigger($resource, $action, $params = [])
  {
    try {
      return $this->client->{$resource}->$action($params);
    }
    catch (\Exception $e) {
        if ($e instanceof RestException) {
            print '[ERROR] ' . $e->getMessage() . "\n";
            foreach ($e->getErrors() as $key => $value) {
                print '[' . $key . '] ' . implode(',', $value) . "\n";
            }
        } else {
            print '[ERROR] ' . $e->getMessage() . "\n";
        }
        return;
    }
  }

}
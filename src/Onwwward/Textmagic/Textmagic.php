<?php

namespace Onwwward\Textmagic;

use ReflectionClass;
use Illuminate\Support\Facades\Log;
use Textmagic\Services\RestException;
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
   * Call a fucntion on the client instance in order to catch and log any ezceptions.
   * 
   * @param  name $resource [description]
   * @param  name $action   [description]
   * @param  array $params   [description]
   * @return mixed 
   */
  public function trigger($resource, $action, $params = [], $logLevel = 'warning')
  {
    try {
      return $this->client->{$resource}->$action($params);
    }
    catch (RestException $e) {
      $message = sprintf('textmagic - %s%s', $e->getMessage(), (empty($e->getErrors()) ? '' : ':'));
      
      foreach ($e->getErrors() as $key => $value) {
        $message .= "\n" . '[' . $key . '] ' . implode(',', $value);
      }  

      Log::$logLevel($message);

      return false;
    }
  }

}
<?php

namespace AppHttp;
use IlluminateFoundationHttpKernel as HttpKernel;

class Kernel extends HttpKernel {

  /**
   * The application's global HTTP middleware stack.
   *
   * @var array
   */
  protected $middleware = [
    FruitcakeCorsHandleCors::class,
    IlluminateFoundationHttpMiddlewareCheckForMaintenanceMode::class,
    IlluminateCookieMiddlewareAddQueuedCookiesToResponse::class,
    IlluminateSessionMiddlewareStartSession::class,
    IlluminateViewMiddlewareShareErrorsFromSession::class
  ];

  /**
   * The application's route middleware.
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth.basic' => IlluminateAuthMiddlewareAuthenticateWithBasicAuth::class,
  ];

}

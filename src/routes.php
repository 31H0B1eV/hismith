<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Controllers\CommentsController;

/**
 * Register controllers
 */
$app['comments.controller'] = function() {
    return new CommentsController();
};

/**
 * Application routes
 */
$app->get('/', 'comments.controller:indexAction');
$app->get('/comment/{id}', 'comments.controller:commentAction');
$app->match('/comments/new', 'comments.controller:formAction');
$app->match('/comments/add', 'comments.controller:addAction');

/**
 * Handle errors
 */
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
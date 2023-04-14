<?php

namespace App\Exceptions;

use App\Models\Erreur;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Throwable;
use ErrorException;
use Illuminate\Support\Facades\Route as LaravelRoute;
use \Illuminate\Support\Facades\Request as LaravelRequest;


class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            dd("eza");
            try {
                $this->saveError($e);
            } catch (\Exception $e) {
                redirect(route('home'));
            }
        });
    }

    private function saveError(Throwable $e): void
    {
        $erreur = new Erreur;
        $erreur->exception = get_class($e);
        $erreur->message = $e->getMessage();
        $erreur->code = (string)$e->getCode();
        $erreur->file = $e->getFile();
        $erreur->line = $e->getLine();
        $erreur->trace = $e->getTraceAsString();
        $erreur->message = $e->getMessage();
        $erreur->referer = LaravelRequest::server('HTTP_REFERER');
        $erreur->ip = LaravelRequest::ip();
        $erreur->port = LaravelRequest::server('SERVER_PORT');
        $erreur->uri = LaravelRequest::fullUrl();
        $erreur->request = LaravelRequest::all() ? json_encode(LaravelRequest::all()) : null;
        $erreur->method = LaravelRequest::method();
        $erreur->user_id = Auth::id();

        if ($e instanceof ErrorException) {
            $erreur->severity = $e->getSeverity();
        }

        if ($argv = LaravelRequest::server('argv', null)) {
            $erreur->route = implode(' ', $argv);
        } else {
            $erreur->route = LaravelRoute::currentRouteName();
            $erreur->route_action = LaravelRoute::currentRouteAction();
        }

        $erreur->save();
    }
}

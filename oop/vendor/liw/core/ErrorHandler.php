<?php
/**
 * Created by PhpStorm.
 * User: radik
 * Date: 24.06.17
 * Time: 20:31
 */

namespace liw\core;


class ErrorHandler
{

    public function register()
    {
        set_error_handler([$this, 'errorHandler']);

        register_shutdown_function([$this, 'fatalError']);

        set_exception_handler([$this, 'exception']);
//
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->showError($errno, $errstr, $errfile, $errline);
        return true;
    }

    public function fatalError()
    {
        $error = error_get_last();
        if (!empty($error) && ($error['type'] == E_ERROR
                || $error['type'] == E_PARSE
                || $error['type'] == E_COMPILE_ERROR
                || $error['type'] == E_CORE_ERROR)) {

            ob_end_clean();
            $this->showError($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    public function exception($exception)
    {
        $this->showError(get_class($exception),  $exception->getMessage(),
            $exception->getFile(), $exception->getLine());
    }

    protected function showError($errno, $errstr, $errfile, $errline, $status = 500)
    {
        header("HTTP/1.1 {$status}");
        echo "Error Number: $errno" . "<hr>" . "$errstr"
              . "<hr>" . "$errfile" . "<hr>" . "$errline" . "<hr>";
    }
}


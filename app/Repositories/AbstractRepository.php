<?php

namespace PremierNewsletter\Repositories;

/**
 * Abstract Repositories.
 */
abstract class AbstractRepository
{
    const NOTIFIER_CLASS_SUCCESS = "updated";
    const NOTIFIER_CLASS_WARN = "update-nag";
    const NOTIFIER_CLASS_ERROR = "error";

    public function configNotifier($message, $class){
        return [
            'message' => $message,
            'class' => $class
        ];
    }
}

<?php

namespace App\Exception;

trait ExceptionMessageTrait
{
    /**
     * Common format message for public
     *
     * @param string $msg
     * @param integer|null $code
     * @return string
     */
    protected function getExMessage(string $msg, ?int $code): string
    {
        $code = $code ? $code : 99999;
        return sprintf('%s Code: %s', $msg, $code);
    }
}

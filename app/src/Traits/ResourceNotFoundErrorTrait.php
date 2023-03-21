<?php

namespace App\Traits;

use App\Exception\UnicornNotFoundException;

trait ResourceNotFoundErrorTrait
{
    protected function getNotFoundErrorMessage(UnicornNotFoundException $ex): array
    {
        return [
            [
                "@context" =>  "/api/contexts/Error",
                "@type" => "hydra:Error",
                "hydra:title" =>  "An error occurred",
                "hydra:description" =>  $ex->getMessage(),
            ],
            400
        ];
    }
}

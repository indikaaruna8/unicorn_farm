<?php

namespace App\Utill;

use Symfony\Component\Form\FormInterface;

class FormErrorUtill
{
    public static function getViolations(FormInterface $form)
    {
        $errors = [];
        $i = 0;
        foreach ($form->getErrors() as $error) {
            $errors["input_error_" . $i] = $error->getMessage();
            $i++;
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = self::getViolations($childForm)) {
                    foreach ($childErrors as $err) {
                        $errors[] = [
                            'propertyPath' => $childForm->getName(),
                            'message' => (string) $err,
                        ];
                    }
                }
            }
        }

        return $errors;
    }

    public static function getErrors(FormInterface $form)
    {
        $violations = self::getViolations($form);

        return  [
            "@context" => "/api/contexts/ConstraintViolationList",
            "@type" => "ConstraintViolationList",
            "hydra:title" => "An error occurred",
            'violations' => $violations,
        ];
    }
}

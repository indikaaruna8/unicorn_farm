<?php

namespace App\Traits;

use Symfony\Component\Form\FormInterface;

/**
 * Handle api form errors
 */
trait FormErrorTrait
{
    /**
     * Undocumented function
     *
     * @param FormInterface $form validated form
     * @return array
     */
    protected function getViolations(FormInterface $form): array
    {
        $errors = [];
        $i = 0;
        foreach ($form->getErrors() as $error) {
            $errors["input_error_" . $i] = $error->getMessage();
            $i++;
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getViolations($childForm)) {
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

    /**
     * Undocumented function
     *
     * @param FormInterface $form
     * @return array
     */
    protected function getFormValidationErrors(FormInterface $form): array
    {
        $violations = $this->getViolations($form);

        return  [
            "@context" => "/api/contexts/ConstraintViolationList",
            "@type" => "ConstraintViolationList",
            "hydra:title" => "An error occurred",
            'violations' => $violations,
        ];
    }
}

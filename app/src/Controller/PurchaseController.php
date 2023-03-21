<?php

namespace App\Controller;

use ApiPlatform\Validator\Exception\ValidationException;
use App\ApiResource\Purchase;
use App\Entity\Post;
use App\Exception\UnicornNotFoundException;
use App\Form\Type\PurchaseType;
use App\Message\Command\PurchaseCommand;
use App\Repository\UnicornEnthusiastRepository;
use App\Repository\UnicornRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Purchase as PurchaseInfo;
use App\Traits\ExceptionMessageTrait as TraitsExceptionMessageTrait;
use App\Traits\FormErrorTrait;
use App\Traits\ResourceNotFoundErrorTrait;
use Psr\Log\LoggerInterface;

#[AsController]
class PurchaseController extends AbstractController
{
    use TraitsExceptionMessageTrait;
    use FormErrorTrait;
    use ResourceNotFoundErrorTrait;

    public function __construct(
        private UnicornRepository $unicornRepository,
        private UnicornEnthusiastRepository $unicornEnthusiastRepository
    ) {
    }

    #[Route(
        name: 'path_purchase',
        path: '/api/purchase',
        methods: ['POST'],
        defaults: [
            '_api_resource_class' => Post::class,
        ],
    )]
    public function __invoke(MessageBusInterface $bus, Request $request, LoggerInterface $log): Response
    {
        $purchse = new Purchase();
        $form = $this->createForm(PurchaseType::class, $purchse);
        $json = json_decode($request->getContent(), true);
        $form->submit($json);

        if (!$form->isSubmitted()) {
            throw new ValidationException("The form is not submitted.");
        }
        if (!$form->isValid()) {
            $errors =  $this->getFormValidationErrors($form);
            $error =  [
                "violations" =>  $errors
            ];
            return $this->json($error, 422);
        }
        try {
            $unicorne = $this->unicornRepository
                ->findOneBy(['id' =>  $purchse->getUnicornId()]);
            if (!$unicorne) {
                throw new UnicornNotFoundException(sprintf('The unicorn "%s" does not exist.', $purchse->getUnicornId()));
            }

            $unicornEnthusiasts = $this->unicornEnthusiastRepository
                ->findOneBy(['id' =>  $purchse->getUnicornEnthusiastsId()]);
            if (!$unicornEnthusiasts) {
                throw new UnicornNotFoundException(sprintf('The unicorn enthusiast "%s" does not exist.', $purchse->getUnicornEnthusiastsId()));
            }
        } catch (UnicornNotFoundException $ex) {
            [$errorDsc, $code] = $this->getNotFoundErrorMessage($ex);
            return $this->json($errorDsc, $code);
        }

        $purchaseInfo = (new PurchaseInfo())
            ->setUnicornId($unicorne->getId())
            ->setUnicornName($unicorne->getName())
            ->setEmail($unicornEnthusiasts->getEmail())
            ->setUnicornEnthusiastId($unicornEnthusiasts->getId())
            ->setUnicornEnthusiastName($unicornEnthusiasts->getName())
            ->setNoOfPost($unicorne->getPosts()->count());
        try {
            $bus->dispatch(new PurchaseCommand($purchaseInfo, $unicorne->getPosts()));
        } catch (\Exception $ex) {
            $log->error($ex->getMessage(), ['code' => $ex->getCode()]);
            throw new \App\Exception\ApiException($this->getExMessage("Internal Error.", $ex->getCode()));
        }

        return $this->json([
            'no_o_post' => $purchaseInfo->getNoOfPost(),
            'order_id' => $purchaseInfo->getId()
        ], 202);
    }
}

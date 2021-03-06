<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;

/**
 * Description of AuthoredEntitySubscriber
 *
 * @author mzdybel
 */
class AuthoredEntitySubscriber implements EventSubscriberInterface
{
    /**
     *
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }
    
    public static function getSubscribedEvents(): array {
        return [
            KernelEvents::VIEW =>['getAuthenticatedUser', EventPriorities::PRE_WRITE]
        ];
    }
    
    public function getAuthenticatedUser(GetResponseForControllerResultEvent $event) {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        
        /** @var UserInterface $user */
        $user = $this->tokenStorage->getToken()->getUser();
        
//        if ($entity instanceof Contact || Request::METHOD_POST !== $method) {
        if (Request::METHOD_POST !== $method) {
            return;
        }
        
        $entity->setUser($user);
    }

}

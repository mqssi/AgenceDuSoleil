<?php


namespace App\Listener;

use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs as ORMEventPreUpdateEventArgs;
use Doctrine\ORM\Mapping\PreRemove;
use Doctrine\Persistence\Event\PreUpdateEventArgs as EventPreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber{



        /**
         * @var CacheManager
         */
        private $cacheManager;

        /**
         * @var UploaderHelper
         */
        private $uploaderHelper;


        public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
        {
            $this->cacheManager = $cacheManager;
            $this->uploaderHelper = $uploaderHelper;
        }



        public function getSubscribedEvents()
        {
            return [
                'preRemove',
                'preUpdate'
            ];
        }


        public function PreRemove(LifecycleEventArgs $args )
        {

            $entity = $args ->getEntity();

            if(!$entity instanceof Property){

                return;
            }
            
            
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
                
           

        }

       
       
       
        public function PreUpdate(ORMEventPreUpdateEventArgs $args )
        {
            $entity = $args ->getEntity();

            if(!$entity instanceof Property){

                return;
            }
            
            if($entity->getImageFile() instanceof Property){
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
                
            }

        }


}
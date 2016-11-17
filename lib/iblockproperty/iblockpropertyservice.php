<?php
namespace WS\Tools\IblockProperty;

use WS\Tools\Events\EventsManager;
use WS\Tools\Events\EventType;

/**
 * @author Afanasyev Pavel <afanasev@worksolutions.ru>
 */
class IblockPropertyService {
    /**
     * @var EventsManager
     */
    private $eventsManager;

    public function __construct(EventsManager $eventsManager) {
        $this->eventsManager = $eventsManager;
    }

    public function register(PropertyInterface $property) {
        $eventType = EventType::create(EventType::IBLOCK_PROPERTY_BUILD_LIST);
        $this->eventsManager->subscribe($eventType, function () use ($property) {
            return $property->getUserTypeDescription();
        });
    }
}
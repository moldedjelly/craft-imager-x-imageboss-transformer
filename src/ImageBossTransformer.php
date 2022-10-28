<?php
/**
 * ImageBoss transformer for Imager X
 *
 * @link      https://www.spacecat.ninja
 * @copyright Copyright (c) 2021 André Elvan
 */

namespace spacecatninja\imagebosstransformer;

use craft\base\Plugin;

use spacecatninja\imagebosstransformer\models\Settings;
use spacecatninja\imagebosstransformer\transformers\ImageBoss;
use spacecatninja\imagebosstransformer\variables\ImagerVariable;

use craft\web\twig\variables\CraftVariable;

use yii\base\Event;


class ImageBossTransformer extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ImageBossTransformer
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;
        
        // Register transformer with Imager
        Event::on(\spacecatninja\imagerx\ImagerX::class,
            \spacecatninja\imagerx\ImagerX::EVENT_REGISTER_TRANSFORMERS,
            static function (\spacecatninja\imagerx\events\RegisterTransformersEvent $event) {
                $event->transformers['imageboss'] = ImageBoss::class;
            }
        );

        // Register our variables
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('imagebossutil', ImagerVariable::class);
            }
        );
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

}

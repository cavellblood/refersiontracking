<?php
/**
 * Refersion Tracking plugin for Craft CMS
 *
 * Implement Server-side JSON Webhook for Refersion
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   RefersionTracking
 * @since     1.0.0
 */

namespace Craft;

class RefersionTrackingPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Refersion Tracking');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Implement Server-side JSON Webhook for Refersion');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/cavellblood/refersiontracking/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/cavellblood/refersiontracking/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Cavell L. Blood';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://cavellblood.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'publicKey' => array( AttributeType::String, 'label' => 'Public Key', 'default' => '' ),
            'secretKey' => array( AttributeType::String, 'label' => 'Secret key', 'default' => '' ),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('refersiontracking/RefersionTracking_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * @param mixed $settings  The plugin's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }

}
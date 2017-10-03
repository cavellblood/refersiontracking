<?php
/**
 * Refersion Tracking plugin for Craft CMS
 *
 * RefersionTracking Service
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   RefersionTracking
 * @since     1.0.4
 */

namespace Craft;

class RefersionTrackingService extends BaseApplicationComponent
{
	protected $settings;

    public function init ()
    {
        parent::init();

        $plugin = craft()->plugins->getPlugin('refersiontracking');
        if ( !$plugin ) {
            throw new Exception(Craft::t('No plugin exists with the class “{class}”', array( 'class' => 'refersiontracking' )));
        }
        $this->settings = $plugin->getSettings();
    }

    public function getPublicKey ()
    {
        return $this->settings->publicKey;
    }

    public function getSecretKey ()
    {
        return $this->settings->secretKey;
    }

}
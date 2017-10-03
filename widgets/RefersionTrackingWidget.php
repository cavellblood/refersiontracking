<?php
/**
 * Refersion Tracking plugin for Craft CMS
 *
 * RefersionTracking Widget
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   RefersionTracking
 * @since     1.0.4
 */
namespace Craft;
class RefersionTrackingWidget extends BaseWidget
{
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
    public function getBodyHtml()
    {
        // Include our Javascript & CSS
        craft()->templates->includeCssResource('refersiontracking/css/widgets/RefersionTrackingWidget.css');
        craft()->templates->includeJsResource('refersiontracking/js/widgets/RefersionTrackingWidget.js');
        /* -- Variables to pass down to our rendered template */
        $variables = array();
        $variables['settings'] = $this->getSettings();
        return craft()->templates->render('refersiontracking/widgets/RefersionTrackingWidget_Body', $variables);
    }
    /**
     * @return int
     */
    public function getColspan()
    {
        return 1;
    }
    /**
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'someSetting' => array(AttributeType::String, 'label' => 'Some Setting', 'default' => ''),
        );
    }
    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {

/* -- Variables to pass down to our rendered template */

        $variables = array();
        $variables['settings'] = $this->getSettings();
        return craft()->templates->render('refersiontracking/widgets/RefersionTrackingWidget_Settings',$variables);
    }

    /**
     * @param mixed $settings  The Widget's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {

/* -- Modify $settings here... */

        return $settings;
    }
}
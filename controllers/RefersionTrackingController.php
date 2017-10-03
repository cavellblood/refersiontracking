<?php
/**
 * Refersion Tracking plugin for Craft CMS
 *
 * RefersionTracking Controller
 *
 * @author    Cavell L. Blood
 * @copyright Copyright (c) 2017 Cavell L. Blood
 * @link      https://cavellblood.com
 * @package   RefersionTracking
 * @since     1.0.0
 */

namespace Craft;

class RefersionTrackingController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    /**
     */
    public function actionSend()
    {

        RefersionTrackingPlugin::log("Path: " . craft()->request->getQueryStringWithoutPath(), LogLevel::Info, true);

        (int)$itemCount = craft()->request->getParam('items');
        $items = array();

        for ($i = 1; $i < ($itemCount + 1); $i++) {
            $items[] = array(
                'price' => craft()->request->getParam('price-' . $i ),
                'quantity' => craft()->request->getParam('qty-' . $i ),
                'sku' => craft()->request->getParam('sku-' . $i )
            );
        }

        // The complete data that you are sending
        $order_data = array(
            'refersion_public_key' => craft()->refersionTracking->getPublicKey(),
            'refersion_secret_key' => craft()->refersionTracking->getSecretKey(),
            'cart_id'              => craft()->request->getParam('cart_id'),
            'order_id'             => craft()->request->getParam('order_id'),
            'shipping'             => craft()->request->getParam('shipping'),
            'tax'                  => craft()->request->getParam('tax'),
            'discount'             => craft()->request->getParam('discount'),
            'discount_code'        => craft()->request->getParam('discount_code'),
            'currency_code'        => craft()->request->getParam('currency_code'),

            'customer' => array(
                'first_name' => craft()->request->getParam('first_name'),
                'last_name'  => craft()->request->getParam('last_name'),
                'email'      => craft()->request->getParam('email')
            ),

            'items' => $items
        );

        // Convert array into JSON
        $json_data = json_encode($order_data);

        // The URL that you are posting to
        $url = 'https://www.refersion.com/tracker/v3/webhook';

        // Start cURL
        $curl = curl_init($url);

        // Verify that our SSL is active (for added security)
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        // Send as a POST
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        // The JSON data that you have already compiled
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);

        // Return the response
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // Set headers to be JSON-friendly
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data))
        );

        // Seconds (5) before giving up
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

        // Execute post, capture response (if any) and status code
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Close connection
        curl_close($curl);

        craft()->end();

    }
}
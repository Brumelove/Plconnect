<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Insights\V1;

use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class CallSummaryContext extends InstanceContext {
    /**
     * Initialize the CallSummaryContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $callSid The call_sid
     * @return \Twilio\Rest\Insights\V1\CallSummaryContext 
     */
    public function __construct(Version $version, $callSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('callSid' => $callSid, );

        $this->uri = '/Voice/' . rawurlencode($callSid) . '/Summary';
    }

    /**
     * Fetch a CallSummaryInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return CallSummaryInstance Fetched CallSummaryInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch($options = array()) {
        $options = new Values($options);

        $params = Values::of(array('ProcessingState' => $options['processingState'], ));

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new CallSummaryInstance($this->version, $payload, $this->solution['callSid']);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Insights.V1.CallSummaryContext ' . implode(' ', $context) . ']';
    }
}
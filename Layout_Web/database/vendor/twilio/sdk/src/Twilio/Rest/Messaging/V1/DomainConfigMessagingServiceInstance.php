<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Messaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $domainSid
 * @property string|null $configSid
 * @property string|null $messagingServiceSid
 * @property string|null $fallbackUrl
 * @property string|null $callbackUrl
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $url
 */
class DomainConfigMessagingServiceInstance extends InstanceResource
{
    /**
     * Initialize the DomainConfigMessagingServiceInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $messagingServiceSid Unique string used to identify the Messaging service that this domain should be associated with.
     */
    public function __construct(Version $version, array $payload, string $messagingServiceSid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'domainSid' => Values::array_get($payload, 'domain_sid'),
            'configSid' => Values::array_get($payload, 'config_sid'),
            'messagingServiceSid' => Values::array_get($payload, 'messaging_service_sid'),
            'fallbackUrl' => Values::array_get($payload, 'fallback_url'),
            'callbackUrl' => Values::array_get($payload, 'callback_url'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['messagingServiceSid' => $messagingServiceSid ?: $this->properties['messagingServiceSid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return DomainConfigMessagingServiceContext Context for this DomainConfigMessagingServiceInstance
     */
    protected function proxy(): DomainConfigMessagingServiceContext
    {
        if (!$this->context) {
            $this->context = new DomainConfigMessagingServiceContext(
                $this->version,
                $this->solution['messagingServiceSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the DomainConfigMessagingServiceInstance
     *
     * @return DomainConfigMessagingServiceInstance Fetched DomainConfigMessagingServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DomainConfigMessagingServiceInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Messaging.V1.DomainConfigMessagingServiceInstance ' . \implode(' ', $context) . ']';
    }
}


<?php

namespace PsychoB\EOS\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use PsychoB\EOS\Entity\AbstractEntity;
use PsychoB\EOS\Exception\RpcException;

abstract class AbstractApi
{
    /** @var Client */
    protected $client;

    /** @var LoggerInterface */
    protected $logger;

    /** @var string */
    protected $uri;

    /**
     * AbstractApi constructor.
     *
     * @param string $uri
     * @param string|null $user
     * @param string|null $pass
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(
        string $uri,
        ?string $user = null,
        ?string $pass = null,
        ?Client $client = null,
        ?LoggerInterface $logger = null
    ) {
        if (!$client) {
            $options = [];

            if ($user) {
                $options['auth'] = [
                    $user, $pass
                ];
            }

            $client = new Client($options);
        }

        $this->uri = $uri;
        $this->client = $client;
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param string $uri
     * @param string|array|null $params
     * @param string|null $class
     * @param bool $removeNulls
     * @return AbstractEntity|array
     */
    protected function request(
        string $uri,
        $params = null,
        ?string $class = null,
        bool $removeNulls = true
    ) {
        $options = [
            'allow_redirects' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        if (!empty($params)) {
            $ret = $params;
            if ($removeNulls && is_array($params)) {
                $ret = [];

                foreach ($params as $key => $value) {
                    if ($value !== null) {
                        $ret[$key] = $value;
                    }
                }
            }

            if (!empty($ret)) {
                $options['json'] = $ret;
            }
        }

        try {
            $this->logger->debug(sprintf('EOS POST %s%s', $this->uri, $uri), [
                'base' => $this->uri,
                'uri' => $uri,
                'options' => $options,
            ]);
            $response = $this->client->request('POST', $this->uri . $uri, $options);
        } catch (GuzzleException $e) {
            throw new RpcException('Bad request', $e);
        }

        $body = $response->getBody()->getContents();
        try {
            $body = json_decode($body, true, 512, JSON_BIGINT_AS_STRING | JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
            throw new RpcException("Can't decode message", $exception);
        }

        if ($class) {
            $body = new $class($body);
        }

        return $body;
    }

    protected function dateToString(?\DateTime $time): ?string
    {
        if ($time === null) {
            return $time;
        }

        return $time->format('Y-m-d H:i');
    }
}

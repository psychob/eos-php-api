<?php

namespace PsychoB\EOS\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
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
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(string $uri, Client $client, LoggerInterface $logger)
    {
        $this->uri = $uri;
        $this->client = $client;
        $this->logger = $logger;
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
            if ($removeNulls) {
                $ret = [];

                foreach ($params as $key => $value) {
                    if ($value !== null) {
                        $ret[$key] = $value;
                    }
                }
            }

            if (!empty($ret)) {
                $options['form_params'] = $ret;
            }
        }

        try {
            $this->logger->debug(sprintf('EOS POST %s%s', $this->uri, $uri), [
                'base' => $this->uri,
                'uri' => $uri,
                'options' => $options,
            ]);
            $rq = $this->client->request('POST', $this->uri . $uri, $options);

            $response = $this->client->send($rq);
        } catch (GuzzleException $e) {
            throw new RpcException('Bad request', $e);
        }

        $body = $response->getBody()->getContents();
        $body = json_decode($body, true);

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

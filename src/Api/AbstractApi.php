<?php

namespace PsychoB\EOS\Api;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use PsychoB\EOS\Entity\AbstractEntity;

abstract class AbstractApi
{
    /** @var Client */
    protected $client;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * AbstractApi constructor.
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    protected function request(string $uri, ?array $params, string $class, bool $removeNulls = true): AbstractEntity
    {
    }

    protected function dateToString(?\DateTime $time): ?string
    {
        if ($time === null) {
            return $time;
        }
    }
}

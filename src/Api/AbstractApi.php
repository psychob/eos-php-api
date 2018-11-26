<?php

namespace PsychoB\EOS\Api;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

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
}

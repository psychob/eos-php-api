<?php

namespace PsychoB\EOS\Api;

use PsychoB\EOS\Entity\AbstractEntity;
use PsychoB\EOS\Exception\RpcException;

class WalletApi extends AbstractApi
{
    public function create(string $fileName)
    {
        return $this->request('/v1/wallet/create', $fileName);
    }

    public function open(string $fileName)
    {
        return $this->request('/v1/wallet/open', $fileName);
    }

    public function lock(string $fileName)
    {
        return $this->request('/v1/wallet/lock', $fileName);
    }

    public function lockAll()
    {
        return $this->request('/v1/wallet/lock_all');
    }

    public function unlock(string $fileName, string $password)
    {
        try {
            return $this->request('/v1/wallet/unlock', [$fileName, $password]);
        } catch (RpcException $e) {
            $message = json_decode($e->getPrevious()->getResponse()->getBody()->__toString(), true);

            if (strpos(strtolower($message['error']['what']), 'already unlocked') !== false) {
                return true;
            }

            throw $e;
        }
    }

    public function importKey(string $fileName, string $privateKey)
    {
        return $this->request('/v1/wallet/import_key', [$fileName, $privateKey]);
    }

    public function listWallets()
    {
        return $this->request('/v1/wallet/list_wallets');
    }

    public function listKeys()
    {
        return $this->request('/v1/wallet/list_keys');
    }

    public function getPublicKeys()
    {
        return $this->request('/v1/wallet/get_public_keys');
    }

    public function setTimeout()
    {
        return $this->request('/v1/wallet/set_timeout');
    }

    public function signTransaction(array $txn, array $keys, $id = '')
    {
        return $this->request('/v1/wallet/sign_transaction', [
            /*'txn' => */$txn,
            /*'keys' => */$keys,
            /*'id' => */$id,
        ], AbstractEntity::class);
    }

    public function setDir()
    {
        return $this->request('/v1/wallet/set_dir');
    }

    public function setEosioKey()
    {
        return $this->request('/v1/wallet/set_eosio_key');
    }

    public function createKey()
    {
        return $this->request('/v1/wallet/create_key');
    }

    public function signDigest()
    {
        return $this->request('/v1/wallet/sign_digest');
    }
}

<?php

namespace PsychoB\EOS\Api;

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

    public function unlock(string $fileName)
    {
        return $this->request('/v1/wallet/unlock', $fileName);
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

    public function signTransaction($txn, $keys, $id)
    {
        return $this->request('/v1/wallet/sign_transaction', [
            'txn' => $txn,
            'keys' => $keys,
            'id' => $id,
        ]);
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

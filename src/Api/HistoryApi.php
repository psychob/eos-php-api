<?php

namespace PsychoB\EOS\Api;

use PsychoB\EOS\Entity\History\ActionsInfo;
use PsychoB\EOS\Entity\History\ControlledAccounts;
use PsychoB\EOS\Entity\History\KeyAccounts;
use PsychoB\EOS\Entity\Transaction\GetTransaction;

class HistoryApi extends AbstractApi
{
    public function getActions(?int $pos = null, ?int $offset = null, ?string $accName = null): ActionsInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/history/get_actions', [
            'pos' => $pos,
            'offset' => $offset,
            'account_name' => $accName,
        ], ActionsInfo::class);
    }

    public function getTransaction(string $id, ?string $blockNumHint = null): GetTransaction
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/history/get_transaction', [
            'id' => $id,
            'block_num_hint' => $blockNumHint,
        ], GetTransaction::class);
    }

    public function getKeyAccounts(string $publicKey): KeyAccounts
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/history/get_key_accounts', [
            'public_key' => $publicKey,
        ], KeyAccounts::class);
    }

    public function getControlledAccounts(string $controllingAccount): ControlledAccounts
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/history/get_controlled_accounts', [
            'controlling_account' => $controllingAccount,
        ], ControlledAccounts::class);
    }
}

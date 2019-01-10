<?php

namespace PsychoB\EOS\Api;

use PsychoB\EOS\Entity\Chain\AccountAbi;
use PsychoB\EOS\Entity\Chain\AccountBalance;
use PsychoB\EOS\Entity\Chain\AccountCode;
use PsychoB\EOS\Entity\Chain\AccountCodeAbi;
use PsychoB\EOS\Entity\Chain\AccountInfo;
use PsychoB\EOS\Entity\Chain\Binary;
use PsychoB\EOS\Entity\Chain\BlockHeaderInfo;
use PsychoB\EOS\Entity\Chain\BlockInfo;
use PsychoB\EOS\Entity\Chain\CurrencyStats;
use PsychoB\EOS\Entity\Chain\GetInfo;
use PsychoB\EOS\Entity\Chain\Json;
use PsychoB\EOS\Entity\Chain\ProducersInfo;
use PsychoB\EOS\Entity\Chain\PushBlockInfo;
use PsychoB\EOS\Entity\Chain\PushTransaction;
use PsychoB\EOS\Entity\Chain\RequiredKeys;
use PsychoB\EOS\Entity\Chain\TableRows;

class ChainApi extends AbstractApi
{
    public function getInfo(): GetInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_info', null, GetInfo::class);
    }

    public function getBlock($idOrNumber): BlockInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_block', [
            'block_num_or_id' => $idOrNumber,
        ], BlockInfo::class);
    }

    public function getBlockById(string $id): BlockInfo
    {
        return $this->getBlock($id);
    }

    public function getBlockByNumber(string $number): BlockInfo
    {
        return $this->getBlock($number);
    }

    public function getBlockHeaderStateById(string $id): BlockHeaderInfo
    {
        return $this->getBlockHeaderState($id);
    }

    public function getBlockHeaderStateByNumber(string $number): BlockHeaderInfo
    {
        return $this->getBlockHeaderState($number);
    }

    public function getBlockHeaderState($idOrNumber): BlockHeaderInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_block_header_state', [
            'block_num_or_id' => $idOrNumber,
        ], BlockHeaderInfo::class);
    }

    public function getAccount(string $accName): AccountInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_account', [
            'account_name' => $accName,
        ], AccountInfo::class);
    }

    public function getAbi(string $accName): AccountAbi
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_abi', [
            'account_name' => $accName,
        ], AccountAbi::class);
    }

    public function getCode(string $accName): AccountCode
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_code', [
            'account_name' => $accName,
        ], AccountCode::class);
    }

    public function getRawCodeAndAbi(string $accName): AccountCodeAbi
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_raw_code_and_abi', [
            'account_name' => $accName,
        ], AccountCodeAbi::class);
    }

    public function getTableRows(
        string $scope,
        string $code,
        string $table,
        ?string $tableKey = null,
        ?bool $json = null,
        ?string $lowerBound = null,
        ?string $upperBound = null,
        ?int $limit = null,
        ?string $indexPosition = null,
        ?string $keyType = null,
        ?string $encodeType = null
    ): TableRows {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_table_rows', [
            'scope' => $scope,
            'code' => $code,
            'table' => $table,
            'table_key' => $tableKey,
            'json' => $json,
            'lower_bound' => $lowerBound,
            'upper_bound' => $upperBound,
            'limit' => $limit,
            'index_position' => $indexPosition,
            'key_type' => $keyType,
            'encode_type' => $encodeType,
        ], TableRows::class);
    }

    public function getTableByScope(
        string $code,
        ?string $table = null,
        ?string $lowerBound = null,
        ?string $upperBound = null,
        ?int $limit = null
    ): TableRows {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_table_by_scope', [
            'code' => $code,
            'table' => $table,
            'lower_bound' => $lowerBound,
            'upper_bound' => $upperBound,
            'limit' => $limit,
        ], TableRows::class);
    }

    public function getCurrencyBalance(
        string $account,
        string $code = 'eosio.token',
        ?string $symbol = null
    ): array {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_currency_balance', [
            'code' => $code,
            'account' => $account,
            'symbol' => $symbol,
        ]);
    }

    public function abiJsonToBin(?string $code = null, ?string $action = null, array $json = null): Binary
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/abi_json_to_bin', [
            'code' => $code,
            'action' => $action,
            'args' => $json,
        ], Binary::class);
    }

    public function binToAbiJson(string $code, string $action, string $binargs): Json
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/abi_bin_to_json', [
            'code' => $code,
            'action' => $action,
            'binargs' => $binargs,
        ], Json::class);
    }

    public function getRequiredKeys(string $transaction, array $availableKeys): RequiredKeys
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_required_keys', [
            'transaction' => $transaction,
            'available_keys' => $availableKeys,
        ], RequiredKeys::class);
    }

    public function getCurrencyStats(?string $code = null, ?string $symbol = null): CurrencyStats
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_currency_stats', [
            'code' => $code,
            'symbol' => $symbol,
        ], CurrencyStats::class);
    }

    public function getProducers(?string $limit = null, ?string $lowerBounds = null, ?bool $json = null): ProducersInfo
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/get_producers', [
            'limit' => $limit,
            'lower_bounds' => $lowerBounds,
            'json' => $json,
        ], ProducersInfo::class);
    }

    public function pushBlock(
        ?\DateTime $timeStamp = null,
        ?string $producer = null,
        ?int $confirmed = null,
        ?string $previous = null,
        ?string $txMroot = null,
        ?int $actionMroot = null,
        ?string $version = null,
        ?array $newProducers = null,
        ?array $headerExtensions = null,
        ?string $producerSignature = null,
        ?array $transactions = null,
        ?array $blockExtensions = null
    ): PushBlockInfo {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/push_block', [
            'timestamp' => $this->dateToString($timeStamp),
            'producer' => $producer,
            'confirmed' => $confirmed,
            'previous' => $previous,
            'transaction_mroot' => $txMroot,
            'action_mroot' => $actionMroot,
            'version' => $version,
            'new_producers' => $newProducers,
            'header_extensions' => $headerExtensions,
            'producer_signature' => $producerSignature,
            'transactions' => $transactions,
            'block_extensions' => $blockExtensions,
        ], PushBlockInfo::class);
    }

    public function pushTransaction(
        ?array $signatures = null,
        ?string $compression = null,
        ?string $ctxFreeData = null,
        ?string $packedTrx = null
    ): PushTransaction {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->request('/v1/chain/push_transaction', [
            'signatures' => $signatures,
            'compression' => $compression,
            'packed_context_free_data' => $ctxFreeData,
            'packed_trx' => $packedTrx,
        ], PushTransaction::class);
    }
}

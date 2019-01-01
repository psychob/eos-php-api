<?php

namespace PsychoB\EOS\Entity\Transaction;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class GetTransaction
 *
 * @method string getId()
 * @method int getBlockNum()
 * @method int getLastIrreversibleBlock()
 * @method array getTraces()
 */
class GetTransaction extends AbstractEntity
{
    public function getBlockTime(): \DateTime
    {
        return $this->toDateTime($this->data['block_time']);
    }

    /**
     * @return GetTransactionTrx|GetTransactionDetailedTrx
     */
    public function getTrx(): GetTransactionTrx
    {
        if (array_key_exists('trx', $this->data['trx'])) {
            return new GetTransactionDetailedTrx($this->data['trx']);
        }

        return new GetTransactionTrx($this->data['trx']);
    }
}

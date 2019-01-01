<?php

namespace PsychoB\EOS\Entity\Chain;

use PsychoB\EOS\Entity\AbstractEntity;
use PsychoB\EOS\Entity\Transaction\DetailedTransaction;
use PsychoB\EOS\Entity\Transaction\SimpleTransaction;

/**
 * Class BlockInfo
 *
 * @method string getProducer()
 * @method int getConfirmed()
 * @method string getPrevious()
 * @method string getTransactionMroot()
 * @method string getActionMroot()
 * @method int getScheduleVersion()
 * @method string getProducerSignature()
 * @method string getId()
 * @method int getBlockNum()
 * @method int getRefBlockPrefix()
 */
class BlockInfo extends AbstractEntity
{
    private $transactionsCache = null;

    public function getTimestamp(): \DateTime
    {
        return $this->toDateTime($this->data['timestamp']);
    }

    /**
     * @return SimpleTransaction[]|DetailedTransaction[]
     */
    public function getTransactions(): array
    {
        if (!$this->transactionsCache) {
            $this->transactionsCache = [];

            foreach ($this->data['transactions'] as $trx) {
                if (is_string($trx['trx'])) {
                    $this->transactionsCache[] = new SimpleTransaction($trx);
                } else {
                    $this->transactionsCache[] = new DetailedTransaction($trx);
                }
            }
        }

        return $this->transactionsCache;
    }
}

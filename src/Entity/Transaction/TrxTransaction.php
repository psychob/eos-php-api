<?php

namespace PsychoB\EOS\Entity\Transaction;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class TrxTransaction
 *
 * @method string getId()
 * @method string[] getSignatures()
 * @method string getCompression()
 * @method string getPackedContextFreeData()
 * @method string getContextFreeData()
 * @method string getPackedTrx()
 */
class TrxTransaction extends AbstractEntity
{
    public function getTransaction(): InnerTrxTransaction
    {
        return new InnerTrxTransaction($this->data['transaction']);
    }
}

<?php

namespace PsychoB\EOS\Entity\Chain;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class PushTransaction
 *
 * @method string getTransactionId()
 */
class PushTransaction extends AbstractEntity
{
    public function getProcessed(): Processed
    {
        return new Processed($this->data['processed']);
    }
}

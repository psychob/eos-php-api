<?php

namespace PsychoB\EOS\Entity\Transaction;

class DetailedTransaction extends BasicTransaction
{
    public function getTrx(): TrxTransaction
    {
        return new TrxTransaction($this->data['trx']);
    }
}

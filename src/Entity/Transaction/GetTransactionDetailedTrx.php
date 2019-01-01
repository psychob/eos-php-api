<?php
//
// eos-api
// (c) 2019 Look4App <https://l4a-soft.com>
// (c) 2019 Andrzej Budzanowski <andrzej.budzanowski@l4a-soft.com>
//

namespace PsychoB\EOS\Entity\Transaction;

class GetTransactionDetailedTrx extends GetTransactionTrx
{
    public function getTrx(): InnerTrxTransaction
    {
        return new InnerTrxTransaction($this->data['trx']);
    }
}

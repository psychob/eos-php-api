<?php
//
// eos-api
// (c) 2019 Look4App <https://l4a-soft.com>
// (c) 2019 Andrzej Budzanowski <andrzej.budzanowski@l4a-soft.com>
//

namespace PsychoB\EOS\Entity\Transaction;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class GetTransactionTrx
 */
class GetTransactionTrx extends AbstractEntity
{
    public function getReceipt(): Receipt
    {
        return new Receipt($this->data['receipt']);
    }
}

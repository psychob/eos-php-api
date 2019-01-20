<?php
//
// eos-api
// (c) 2019 Look4App <https://l4a-soft.com>
// (c) 2019 Andrzej Budzanowski <andrzej.budzanowski@l4a-soft.com>
//

namespace PsychoB\EOS\Entity\Wallet;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class SignTransaction
 *
 * @method int getRefBlockNum()
 * @method int getRefBlockPrefix()
 * @method int getMaxNetUsageWords()
 * @method int getMaxCpuUsageMs()
 * @method int getDelaySec()
 * @method array getContextFreeActions()
 * @method array getTransactionExtensions()
 * @method array getSignatures()
 * @method array getContextFreeData()
 */
class SignTransaction extends AbstractEntity
{
    public function getExpiration(): \DateTime
    {
        return $this->toDateTime($this->data['expiration']);
    }
}

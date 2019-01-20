<?php
//
// eos-api
// (c) 2019 Look4App <https://l4a-soft.com>
// (c) 2019 Andrzej Budzanowski <andrzej.budzanowski@l4a-soft.com>
//

namespace PsychoB\EOS\Entity\Chain;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class Processed
 *
 * @method string getId()
 * @method int getBlockNum()
 * @method string|null getProducerBlockId()
 * @method int getElapsed()
 * @method int getNetUsage()
 * @method bool getScheduled()
 * @method string|null getExcept()
 */
class Processed extends AbstractEntity
{
    public function getBlockTime(): \DateTime
    {
        return $this->toDateTime($this->data['block_time']);
    }
}

<?php

namespace PsychoB\EOS\Entity\Transaction;

use PsychoB\EOS\Entity\AbstractEntity;

/**
 * Class InnerTrxTransaction
 *
 * @method int getRefBlockNum()
 * @method int getRefBlockPrefix()
 * @method int getMaxNetUsageWords()
 * @method int getMaxCpuUsageMs()
 * @method int getDelaySec()
 * @method array getContextFreeActions()
 * @method array getTransactionExtensions()
 */
class InnerTrxTransaction extends AbstractEntity
{
    public function getActions(): array
    {
        $actions = [];

        foreach ($this->data['actions'] as $action) {
            $actions[] = new Action($action);
        }

        return $actions;
    }
}

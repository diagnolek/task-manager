<?php

namespace App\Workflows\Simple;

use Workflow\ActivityStub;
use Workflow\QueryMethod;
use Workflow\SignalMethod;
use Workflow\Workflow;

class SimpleWorkflow extends Workflow
{

    protected bool $ready = false;

    #[SignalMethod]
    public function setReady($ready): void
    {
        $this->ready = $ready;
    }

    #[QueryMethod]
    public function getReady(): bool
    {
        return $this->ready;
    }


    public function execute()
    {
        $result = yield ActivityStub::make(SimpleActivity::class);

        $otherResult = yield ActivityStub::make(SimpleOtherActivity::class, 'other');

        return 'workflow_' . $result . '_' . $otherResult;
    }
}

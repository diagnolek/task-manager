<?php

namespace Tests\Feature;

use App\Workflows\Simple\SimpleActivity;
use App\Workflows\Simple\SimpleOtherActivity;
use App\Workflows\Simple\SimpleWorkflow;
use Tests\TestCase;
use Workflow\WorkflowStub;

class SimpleWorkflowTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testWorkflow()
    {
        WorkflowStub::fake();

        WorkflowStub::mock(SimpleActivity::class, function ($context) {
            return 'simple';
        });

        WorkflowStub::mock(SimpleOtherActivity::class, function ($context) {
            return 'other';
        });

        $workflow = WorkflowStub::make(SimpleWorkflow::class);
        $workflow->start();

        $this->assertSame($workflow->output(), 'workflow_simple_other');
    }
}

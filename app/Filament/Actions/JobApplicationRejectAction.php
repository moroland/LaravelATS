<?php
/**
 * @file JobApplicationActions.php
 */

namespace App\Filament\Actions;

use App\Models\JobApplication;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;

class JobApplicationRejectAction extends Action {

    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'reject';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->requiresConfirmation();
        $this->successNotificationTitle('Rejected.');
        $this->failureNotificationTitle('Failed to reject.');

        $this->action(function (): void {
            try {
                $result = $this->process(static fn (JobApplication $jobApplication) => $jobApplication->reject());
            } catch (\Exception $e) {
                $this->failureNotificationTitle('Failed to reject: ' . $e->getMessage() );
                $this->failure();

                return;
            }

            if (! $result) {
                $this->failure();

                return;
            }
            $this->getLivewire()->dispatch('applicationRejected');
            $this->success();
        });
    }



}

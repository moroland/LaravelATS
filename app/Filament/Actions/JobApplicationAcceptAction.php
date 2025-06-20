<?php
/**
 * @file JobApplicationActions.php
 */

namespace App\Filament\Actions;

use App\Models\JobApplication;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;

class JobApplicationAcceptAction extends Action {

    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'accept';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->requiresConfirmation();
        $this->successNotificationTitle('Accepted.');
        $this->failureNotificationTitle('Failed to accept.');

        $this->action(function (): void {
            try {
                $result = $this->process(static fn (JobApplication $jobApplication) => $jobApplication->accept());
            } catch (\Exception $e) {
                $this->failureNotificationTitle('Failed to accept: ' . $e->getMessage() );
                $this->failure();

                return;
            }

            if (! $result) {
                $this->failure();

                return;
            }
            $this->getLivewire()->dispatch('applicationAccepted');
            $this->success();
        });
    }



}

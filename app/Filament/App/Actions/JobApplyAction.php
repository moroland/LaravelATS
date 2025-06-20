<?php
/**
 * @file JobApplyAction.php
 */

namespace App\Filament\App\Actions;

use App\Models\Position;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Support\Facades\Auth;

class JobApplyAction extends Action {

    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'apply';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->requiresConfirmation();
        $this->successNotificationTitle('Applied.');
        $this->failureNotificationTitle('Failed to apply.');

        $this->action(function (): void {
            try {
                $result = $this->process(static fn (Position $position) => $position->apply(Auth::user()));
            } catch (\Exception $e) {
                $this->failureNotificationTitle('Failed to apply: ' . $e->getMessage() );
                $this->failure();

                return;
            }

            if (! $result) {
                $this->failure();

                return;
            }
            $this->getLivewire()->dispatch('jobApplied');
            $this->success();
        });
    }

}

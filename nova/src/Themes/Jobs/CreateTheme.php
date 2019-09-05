<?php

namespace Nova\Themes\Jobs;

use Illuminate\Bus\Queueable;
use Nova\Themes\Models\Theme;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTheme implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $theme = Theme::create($this->data);

        Artisan::call('nova:make:theme', [
            'name' => $theme->name,
            '--location' => $theme->location,
        ]);

        return $theme;
    }
}
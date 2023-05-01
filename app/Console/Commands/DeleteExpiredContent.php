<?php

namespace App\Console\Commands;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DeleteExpiredContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired contents';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $contents = Content::all();

        $contents->map(function ($content) {
            if ($content->end_date < Carbon::now()) {
                $content->delete();
                Log::info("content deleted: ", $content->toArray());
            }
        });

        return CommandAlias::SUCCESS;
    }
}

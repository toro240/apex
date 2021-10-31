<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $inputName = $this->argument('name');
        $existUser = User::whereName($inputName)->exists();
        if ($existUser) {
            $this->warn("already exist user " . $inputName);
            return 0;
        }

        $newPassword = User::generateRandomPassword();
        User::create(
            [
                'name' => $inputName,
                'password' => $newPassword,
            ]
        );

        $this->info('user create successful. new password is [' . $newPassword . ']');
        return 0;
    }
}

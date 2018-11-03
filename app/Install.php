<?php

namespace App;

use MadWeb\Initializer\Contracts\Runner;
use MadWeb\Initializer\Jobs\Supervisor\MakeQueueSupervisorConfig;
use MadWeb\Initializer\Jobs\Supervisor\MakeSocketSupervisorConfig;

class Install
{
    public function production(Runner $run)
    {
        return $run
            ->external('composer', 'install', '--no-dev', '--prefer-dist', '--optimize-autoloader')
            ->artisan('key:generate')
            ->artisan('migrate', ['--force' => true])
            ->artisan('storage:link')
//            ->dispatch(new MakeCronTask)
//            ->external('npm', 'install', '--production')
//            ->external('npm', 'run', 'production')
            ->artisan('route:cache')
            ->artisan('config:cache')
            ->external('composer', 'dump-autoload', '--optimize');
    }

    public function productionRoot(Runner $run)
    {
        return $this->localRoot($run);
    }

    public function local(Runner $run)
    {
        return $run
            ->external('composer', 'install')
            ->artisan('key:generate')
            ->artisan('migrate')
            ->artisan('storage:link');
//            ->dispatch(new MakeCronTask)
//            ->external('npm', 'install')
//            ->external('npm', 'run', 'development');
    }

    public function localRoot(Runner $run)
    {
        return $run
            ->dispatch(new MakeQueueSupervisorConfig)
            ->dispatch(new MakeSocketSupervisorConfig)
            ->external('supervisorctl', 'reread')
            ->external('supervisorctl', 'update');
    }
}

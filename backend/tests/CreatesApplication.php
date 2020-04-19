<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    
    public function setUp():void{
        parent::setUp();
        $this->prepareForTests();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    private function prepareForTests(){
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }

    public function tearDown():void{
        parent::tearDown();
    }
}

<?php
namespace Console;

use Symfony\Component\Console\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct('Developer Tools');

        $this->addCommands([
            new Command\Export(),
        ]);
    }
}

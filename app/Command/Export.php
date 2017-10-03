<?php
namespace Console\Command;

use Console\Builder;
use Corp104\Taiwan\Bank\Bank;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Export extends Command
{
    protected function configure()
    {
        $this->setName('export')
            ->setDescription('Export data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bank = new Bank();

        // Get raw data
        $data = $bank->getBankCode();

        // TODO Extract data
    }
}

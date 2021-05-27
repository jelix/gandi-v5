<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Status extends  Command
{
    protected function configure()
    {
        $this
            ->setName('status')
            ->setDescription("Show the Gandi Status")
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiStatus = new \Jelix\GandiApi\ApiV5\Status();
        $status = $apiStatus->getCurrentStatus();
        $exitCode = 0;
        switch($status['indicator']) {
            case \Jelix\GandiApi\ApiV5\Status::STATUS_NONE:
                $output->writeln('All Gandi services are operational');
                break;
            case \Jelix\GandiApi\ApiV5\Status::STATUS_MINOR:
                $output->writeln("<info>Gandi is experiencing a minor trouble: ".$status['description']."</info>");
                break;
            default:
                $output->writeln("<error>Gandi is experiencing a ".$status['indicator']." trouble: ".$status['description']."</error>");
                $exitCode = 1;
        };
        return $exitCode;
    }
}



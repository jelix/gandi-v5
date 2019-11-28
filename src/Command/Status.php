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
        switch($status) {
            case "SUNNY":
                $output->writeln('All Gandi services are operational');
                break;
            default:
                $output->writeln("<error>Gandi is experiencing a bit of trouble: $status</error>");
                $this->setCode(1);

        };
    }


}



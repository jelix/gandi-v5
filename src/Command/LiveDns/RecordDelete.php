<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command\LiveDns;

use Jelix\GandiApi\ApiV5\Entities\ZoneRecord;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Jelix\GandiApi\Command\AbstractCommand;
use Symfony\Component\Console\Helper\Table;

class RecordDelete  extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('livedns:record:delete')
            ->setDescription("Delete a record from a domain.")
            ->addArgument(
                'domain',
                InputArgument::REQUIRED,
                'The domain name of the zone in which the record will be stored'
            )
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The record name'
            )
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                'The record type: A, AAAA, CNAME...'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($this->configuration);

        $record = new ZoneRecord(
            $input->getArgument('name'),
            $input->getArgument('type'),
            []
        );

        $apiLiveDns->deleteRecord($input->getArgument('domain'), $record);
        return 0;
    }

}

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

class RecordCreate  extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('livedns:record:create')
            ->setDescription("Create a record into a domain. It supports only record with a single value.")
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
            ->addArgument(
                'value',
                InputArgument::REQUIRED,
                'the value of the record'
            )
            ->addArgument(
                'ttl',
                InputArgument::OPTIONAL,
                'the ttl of the record'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($this->configuration);

        $ttl = $input->getArgument('ttl');
        $record = new ZoneRecord(
            $input->getArgument('name'),
            $input->getArgument('type'),
            [$input->getArgument('value')],
            $ttl ?: 10800
        );

        $message = $apiLiveDns->createRecord($input->getArgument('domain'), $record);
        $output->writeln($message);
    }

}

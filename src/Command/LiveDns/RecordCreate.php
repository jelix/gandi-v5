<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command\LiveDns;

use Jelix\GandiApi\ApiV5\Entities\ZoneRecord;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addOption(
                'force-update',
                'f',
                InputOption::VALUE_NONE,
                'If the record already exists, this option allow to update it'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($this->configuration);
        $domain = $input->getArgument('domain');
        $ttl = $input->getArgument('ttl');
        $name = $input->getArgument('name');
        $type = $input->getArgument('type');
        $record = new ZoneRecord(
            $name,
            $type,
            [$input->getArgument('value')],
            $ttl ?: 10800
        );

        $existingRecord = $apiLiveDns->getRecord($domain, $name, $type);
        if ($existingRecord) {
            if ($input->getOption('force-update')) {
                $message = $apiLiveDns->updateRecord($domain, $record);
                $output->writeln($message);
            }
            else {
                $output->writeln('<error>The record already exists</error>');
                $output->writeln(json_encode($existingRecord->toJsonData()));
                return 1;
            }
        }
        else {
            $message = $apiLiveDns->createRecord($domain, $record);
            $output->writeln($message);
        }

        return 0;
    }

}

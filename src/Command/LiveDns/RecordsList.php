<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command\LiveDns;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Jelix\GandiApi\Command\AbstractCommand;
use Symfony\Component\Console\Helper\Table;

class RecordsList  extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('livedns:records')
            ->setDescription("Show records of a domain")
            ->addArgument(
                'domain',
                InputArgument::REQUIRED,
                'The domain name'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($this->configuration);
        $records = $apiLiveDns->getRecordsList($input->getArgument('domain'));

        $table = new Table($output);
        $headers = array(
            'Name',
            'Type',
            'Ttl',
            'Value'
        );

        $table->setHeaders($headers);
        foreach($records as $record) {
            $row = array(
                $record->getName(),
                $record->getType(),
                $record->getTtl(),
                implode("\n",$record->getValues()),
            );
            $table->addRow($row);
        }
        $table->render();
        return 0;
    }

}

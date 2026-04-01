<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019-2026 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class OrganizationList  extends AbstractCommand
{

    protected function configure(): void
    {
        $this
            ->setName('organizations')
            ->setDescription("Show list of the organization you can access")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\Organizations($this->configuration);
        $domains = $apiLiveDns->getList();
        $table = new Table($output);
        $headers = array(
            'Name',
            'id',
            'Type'
        );

        $table->setHeaders($headers);
        foreach($domains as $record) {
            $row = array(
                $record->getName(),
                $record->getId(),
                $record->getType(),
            );
            $table->addRow($row);
        }
        $table->render();
        return 0;
    }

}

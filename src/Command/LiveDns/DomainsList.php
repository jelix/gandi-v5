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

class DomainsList  extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('livedns:domains')
            ->setDescription("Show list of domains")
            ->addArgument(
                'org_name',
                InputArgument::OPTIONAL,
                'Organization name'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $apiOrg = new \Jelix\GandiApi\ApiV5\Organizations($this->configuration);

        $orgName = $input->getArgument('org_name');
        if ($orgName) {
            $organization = $apiOrg->getOrganizationByName($orgName);
            if ($organization === null) {
                $output->writeln("<error>Unknown organization</error>");
                return 1;
            }
            $orgId = $organization->getId();
        }
        else {
            $orgId = '';
        }
        $apiLiveDns = new \Jelix\GandiApi\ApiV5\LiveDns($this->configuration);
        $domains = $apiLiveDns->getDomainsList($orgId);
        $table = new Table($output);
        $headers = array(
            'Name',
        );

        $table->setHeaders($headers);
        foreach($domains as $record) {
            $table->addRow([$record]);
        }
        $table->render();
        return 0;
    }

}

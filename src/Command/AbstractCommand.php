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
use Jelix\GandiApi\Configuration;

abstract class AbstractCommand extends Command
{

    /**
     * @var Configuration
     *
     */
    protected $configuration;

    /**
     * Initializes the command just after the input has been validated.
     *
     * So after the configure() method.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->configuration = $this->getApplication()->getConfiguration();
    }

    /**
     * Accepts only \Jelix\GandiApi\Command\Application.
     *
     * @param Application|null $application
     * @throws \Exception
     */
    public function setApplication(\Symfony\Component\Console\Application $application = null)
    {
        if (!$application instanceof \Jelix\GandiApi\Command\Application) {
            throw new \Exception("Wrong application object");
        }
        parent::setApplication($application);
    }
}

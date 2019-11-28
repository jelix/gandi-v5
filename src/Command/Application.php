<?php
/**
 * @author      Laurent Jouanneau
 * @copyright   2019 Laurent Jouanneau
 * @licence     MIT
 */

namespace Jelix\GandiApi\Command;

use Jelix\GandiApi\Configuration;


class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var Configuration
     */
    protected $config;

    public function __construct(Configuration $config, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->config = $config;
        parent::__construct($name, $version);
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->config;
    }
}

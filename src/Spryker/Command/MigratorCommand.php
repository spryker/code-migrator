<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Command;

use Spryker\AbstractMigrator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class MigratorCommand extends Command
{

    const OPTION_DRY = 'dry';
    const OPTION_DRY_SHORT = 'd';

    const OPTION_CORE = 'core';
    const OPTION_CORE_SHORT = 'c';

    const OPTION_PROJECT_NAMESPACE = 'project-namespace';
    const OPTION_PROJECT_NAMESPACE_SHORT = 'p';

    const OPTION_PATH_TO_MIGRATE = 'path-to-migrate';
    const OPTION_PATH_TO_MIGRATE_SHORT = 't';

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * @var \Spryker\AbstractMigrator[]
     */
    protected $updater = [];

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('spryker:migrate')
            ->setDescription('Migrates code to the latest changes made by Spryker.')
            ->addOption(static::OPTION_DRY, static::OPTION_DRY_SHORT, null, 'Use this option to see what will be changed.')
            ->addOption(static::OPTION_CORE, static::OPTION_CORE_SHORT, null, 'Use this option to check core code.')
            ->addOption(
                static::OPTION_PROJECT_NAMESPACE,
                static::OPTION_PROJECT_NAMESPACE_SHORT,
                InputOption::VALUE_OPTIONAL,
                'If you have a different namespace then Pyz in your project or Spryker in core change it with this option',
                'Pyz'
            )
            ->addOption(
                static::OPTION_PATH_TO_MIGRATE,
                static::OPTION_PATH_TO_MIGRATE_SHORT,
                InputOption::VALUE_OPTIONAL,
                'If you need to change files in a different directory then the spryker/spryker default, use this option',
                PROJECT_ROOT . '/vendor/spryker/spryker/Bundles'
            );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $finder = $this->getFinder($output);

        $output->writeln(sprintf('Start checking <fg=green>%d</> files...', $finder->count()));

        foreach ($finder as $fileInfo) {
            $this->runUpdater($fileInfo);
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->defineProjectNamespace($input);
        $path = __DIR__ . '/../../../config/';
        if ($input->hasOption(static::OPTION_CORE) && $input->getOption(static::OPTION_CORE)) {
            $path .= 'core/';
            $output->writeln('Configure for core migration');
        } else {
            $path .= 'project/';
            $output->writeln('Configure for project migration');
        }

        $finder = new Finder();
        $finder->in($path);

        foreach ($finder as $fileInfo) {
            $className = str_replace('.php', '', $fileInfo->getFilename());
            $className = 'Spryker\\Migrator\\' . $className;
            $configuration = require_once $fileInfo->getPathname();

            $migratorClass = new $className($configuration);
            $this->addMigrator($migratorClass);
        }
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \Symfony\Component\Finder\Finder
     */
    protected function getFinder(OutputInterface $output)
    {
        if ($this->input->hasOption(static::OPTION_CORE) && $this->input->getOption(static::OPTION_CORE)) {
            $directories = [
                $this->input->getOption(static::OPTION_PATH_TO_MIGRATE),
            ];
            $output->writeln('Loading files from core');
        } else {
            $directories = [
                PROJECT_ROOT . '/public',
                PROJECT_ROOT . '/src',
                PROJECT_ROOT . '/config',
                PROJECT_ROOT . '/tests',
            ];

            $output->writeln('Loading files from project');
        }

        $finder = new Finder();
        $finder->files()->in($directories);

        return $finder;
    }

    /**
     * @param \Spryker\AbstractMigrator $updater
     *
     * @return $this
     */
    public function addMigrator(AbstractMigrator $updater)
    {
        $this->updater[] = $updater;

        return $this;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     *
     * @return void
     */
    protected function runUpdater(SplFileInfo $fileInfo)
    {
        $content = $fileInfo->getContents();

        foreach ($this->updater as $updater) {
            if (!$updater->accept($fileInfo)) {
                continue;
            }
            $updater->configure($this->input, $this->output, $this);
            $content = $updater->execute($fileInfo, $content);
        }

        if ($content) {
            $this->save($fileInfo, $content);
        }
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $fileInfo
     * @param string $content
     *
     * @return void
     */
    protected function save(SplFileInfo $fileInfo, $content)
    {
        if ($fileInfo->getContents() !== $content) {
            if (!$this->isDryRun()) {
                file_put_contents($fileInfo->getPathname(), $content);
                $this->output->writeln('<bg=yellow;fg=black>Saved new content to:</> <fg=green>' . $fileInfo->getPathname() . '</>');
            }
            $this->output->writeln('');

        }
    }

    /**
     * @return bool
     */
    protected function isDryRun()
    {
        return ($this->input->hasOption(static::OPTION_DRY) && $this->input->getOption(static::OPTION_DRY));
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return void
     */
    private function defineProjectNamespace(InputInterface $input)
    {
        define('PROJECT_NAMESPACE', $input->getOption(static::OPTION_PROJECT_NAMESPACE));
    }

}

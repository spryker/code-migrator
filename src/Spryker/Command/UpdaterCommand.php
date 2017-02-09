<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Command;

use Spryker\AbstractUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Spryker\UpdaterInterface;

class UpdaterCommand extends Command
{
    const OPTION_DRY = 'dry';
    const OPTION_DRY_SHORT = 'd';

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var AbstractUpdater[]
     */
    protected $updater = [];

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('spryker:update')
            ->setDescription('Updates to the latest changes made by Spryker.')
            ->addOption(static::OPTION_DRY, static::OPTION_DRY_SHORT, null, 'Use this option to see what will be changed.')
        ;
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

        $finder = $this->getFinder();

        $output->writeln(sprintf('Start checking <fg=green>%d</> files...', $finder->count()));

        foreach ($finder as $fileInfo) {
            $this->runUpdater($fileInfo);
        }
    }

    /**
     * @return \Symfony\Component\Finder\Finder
     */
    protected function getFinder()
    {
        $finder = new Finder();
        $finder->files()->in([PROJECT_ROOT . '/src', PROJECT_ROOT . '/config']);

        return $finder;
    }

    /**
     * @param \Spryker\AbstractUpdater $updater
     *
     * @return $this
     */
    public function addUpdater(AbstractUpdater $updater)
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
            }
            $this->output->writeln('<bg=yellow;fg=black>Saved new content to:</> <fg=green>' . $fileInfo->getPathname() . '</>');
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


}

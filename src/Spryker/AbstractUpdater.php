<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractUpdater implements UpdaterInterface
{

    const MESSAGE_TEMPLATE_FILE_NAME = '<fg=yellow>%s</>';
    const MESSAGE_MANUALLY = '<fg=red>You need to check this manually</>';

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var Command
     */
    protected $command;

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Symfony\Component\Console\Command\Command $command
     *
     * @return void
     */
    public function configure(InputInterface $input, OutputInterface $output, Command $command)
    {
        $this->input = $input;
        $this->output = $output;
        $this->command = $command;
    }

    /**
     * @param string $message
     *
     * @return void
     */
    protected function outputMessage($message)
    {
        $this->output->writeln($message);
        if ($message === static::MESSAGE_MANUALLY) {
            $this->output->writeln('');
        }
    }

}

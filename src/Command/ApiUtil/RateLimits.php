<?php

namespace Transip\Api\CLI\Command\ApiUtil;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class RateLimits extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apiutil:ratelimits')
            ->setDescription('Get the API rate limit information for current session')
            ->setHelp('Will do a test API call to retrieve rate limit information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getTransipApi()->test()->test();
        $rateLimitReset = $this->getTransipApi()->getRateLimitReset();

        if ($rateLimitReset > 0) {
            $rateLimitReset = date('Y-m-d H:i:s', $rateLimitReset);
        }

        $information = [
            'rateLimitMax'            => $this->getTransipApi()->getRateLimitLimit(),
            'rateLimitCurrent'        => $this->getTransipApi()->getRateLimitRemaining(),
            'rateLimitReset'          => $rateLimitReset,
        ];

        $this->output($information);
        return 0;
    }
}

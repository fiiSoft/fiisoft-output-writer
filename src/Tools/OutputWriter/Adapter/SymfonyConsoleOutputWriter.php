<?php

namespace FiiSoft\Tools\OutputWriter\Adapter;

use InvalidArgumentException;
use FiiSoft\Tools\OutputWriter\AbstractOutputWriter;
use FiiSoft\Tools\OutputWriter\OutputLevel;
use Symfony\Component\Console\Output\OutputInterface;

final class SymfonyConsoleOutputWriter extends AbstractOutputWriter
{
    private static $map = [
        OutputLevel::NORMAL => OutputInterface::VERBOSITY_NORMAL,
        OutputLevel::VERBOSE => OutputInterface::VERBOSITY_VERBOSE,
        OutputLevel::VERY_VERBOSE => OutputInterface::VERBOSITY_VERY_VERBOSE,
        OutputLevel::DEBUG => OutputInterface::VERBOSITY_DEBUG,
        OutputLevel::ERROR => OutputInterface::VERBOSITY_NORMAL,
    ];
    
    /** @var OutputInterface */
    private $output;
    
    /**
     * @param OutputInterface $output
     * @throws InvalidArgumentException
     */
    public function __construct(OutputInterface $output)
    {
        //disable filtering by level because OutputInterface has its own filtering
        $this->setLevel(OutputLevel::DEBUG);
        $this->output = $output;
    }
    
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    protected function write($message, $newLine, $level)
    {
        $this->output->write($message, $newLine, OutputInterface::OUTPUT_NORMAL | self::$map[$level]);
    }
}
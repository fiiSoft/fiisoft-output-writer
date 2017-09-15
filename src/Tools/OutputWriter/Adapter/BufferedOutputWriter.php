<?php

namespace FiiSoft\Tools\OutputWriter\Adapter;

use Countable;
use FiiSoft\Tools\OutputWriter\AbstractOutputWriter;
use FiiSoft\Tools\OutputWriter\OutputLevel;
use FiiSoft\Tools\OutputWriter\OutputWriter;
use LogicException;
use UnexpectedValueException;

final class BufferedOutputWriter extends AbstractOutputWriter implements Countable
{
    /** @var array */
    private $buffer = [];
    
    /**
     * @param string $message
     * @param bool $newLine
     * @param int $level
     * @return void
     */
    protected function write($message, $newLine, $level)
    {
        $this->buffer[] = [
            'message' => $message,
            'newLine' => $newLine,
            'level' => $level
        ];
    }
    
    /**
     * Send all buffered messages to another OutputWriter.
     * Be aware that messages are removed during this process.
     *
     * @param OutputWriter $outputWriter
     * @throws UnexpectedValueException
     * @throws LogicException
     * @return void
     */
    public function flushTo(OutputWriter $outputWriter)
    {
        if ($outputWriter === $this) {
            throw new LogicException('Operation not allowed');
        }
    
        $minLevel = $outputWriter->getLevel();
        
        while (!empty($this->buffer)) {
            $item = array_shift($this->buffer);
    
            if ($item['level'] < $minLevel) {
                continue;
            }
            
            switch ($item['level']) {
                case OutputLevel::ERROR:
                    $outputWriter->error($item['message'], $item['newLine']);
                break;
                case OutputLevel::NORMAL:
                    $outputWriter->normal($item['message'], $item['newLine']);
                break;
                case OutputLevel::VERBOSE:
                    $outputWriter->verbose($item['message'], $item['newLine']);
                break;
                case OutputLevel::VERY_VERBOSE:
                    $outputWriter->veryVerb($item['message'], $item['newLine']);
                break;
                case OutputLevel::DEBUG:
                    $outputWriter->debug($item['message'], $item['newLine']);
                break;
                default:
                    throw new UnexpectedValueException('Unexpected value of level');
            }
        }
    }
    
    /**
     * @return string[]
     */
    public function getBufferedMessages()
    {
        return array_map(function ($item) {return $item['message'];}, $this->buffer);
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->buffer;
    }
    
    /**
     * Clear all buffered messages.
     *
     * @return void
     */
    public function clear()
    {
        $this->buffer = [];
    }
    
    /**
     * Count messages currently hold in buffer.
     *
     * @return int
     */
    public function count()
    {
        return count($this->buffer);
    }
}
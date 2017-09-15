# FiiSoft Output Writer

Library with abstraction of something that is capable to write various types of messages to some kinds of output (like console, or file, or anything).

My advice is - do not use it unless you are enough strong mentally to immune for such bad code. 

#### `OutputWriter`

Main interface of package. The OutputWriter is something that allows to write messages (in most cases to console) with few different levels of important and can filter out messages with level lower then minimal required to write message. 

#### `OutputLevel`

Contains constants with valid levels of messages. Can be use by method OutputWriter::setLevel().
 
#### `ConsoleOutputWriter`

It writes messages directly to current STDOUT (by echo).

#### `SymfonyConsoleOutputWriter`

Is an adapter for Symfony OutputInterface implementation.

#### `BufferedOutputWriter`

This adapter collects messages and is able to flush them to other OutputWriter.
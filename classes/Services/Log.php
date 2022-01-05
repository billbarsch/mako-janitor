<?php
namespace softr\MakoJanitor\Services;

use \mako\file\FileSystem;
use \mako\utility\Collection;

use \Dubture\Monolog\Reader\LogReader;

/**
 * Log janitor service.
 *
 * @author     Agência Softr Ltda
 * @copyright  (c) 2017
 */
class Log
{
    /**
     * FileSystem Instance
     *
     * @var FileSystem
     */
    protected $fileSystem;

    /**
     * Constructor.
     *
     * @param  FileSystem   $fileSystem  FileSystem Instance
     */
    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;

        $this->collection = $this->readLogs();
    }

    /**
     * Return all logs
     *
     * @access  public
     * @return  \mako\utility\Collection
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * Return log in ascending order
     *
     * @return  Log  Log instance
     */
    public function asc()
    {
        $this->collection->sort(function($a, $b) {
            if ($a->date->getTimestamp() == $b->date->getTimestamp()) {
                return 0;
            }

            return $a->date->getTimestamp() < $b->date->getTimestamp() ? -1 : 1;
        });

        return $this;
    }

    /**
     * Return log in descending order
     *
     * @return  Log  Log instance
     */
    public function desc()
    {
        $this->collection->sort(function($a, $b) {
            if ($a->date->getTimestamp() == $b->date->getTimestamp()) {
                return 0;
            }

            return $a->date->getTimestamp() > $b->date->getTimestamp() ? -1 : 1;
        });

        return $this;
    }

    /**
     * Check if log file exists
     *
     * @access  public
     * @param   integer  id  Log Id
     * @return  bool
     */
    public function exists($id)
    {
        return $this->collection->offsetExists($id);
    }

    /**
     * Return log content
     *
     * @access  public
     * @param   integer  id  Log Id
     * @return  string
     */
    public function get($id)
    {
        if ($this->collection->offsetExists($id)) {
            return $this->collection->offsetGet($id);
        }
    }

    /**
     * Delete log file
     *
     * @access  public
     * @param   integer  id  Log Id
     * @return  string
     */
    public function delete($id)
    {
        if ($this->collection->offsetExists($id)) {
            $log = $this->collection->offsetGet($id);

            $basename = str_replace('-', '_', basename($log->file, '.mako'));

            $duplicateFile = MAKO_APPLICATION_PATH . "/storage/logs/error_{$basename}.log";

            if (is_file($duplicateFile)) {
                $this->fileSystem->delete($duplicateFile);
            }

            if (is_file($log->file)) {
                $this->fileSystem->delete($log->file);
            }

            return true;
        }
    }

    /**
     * Read all system logs
     *
     * @return  array
     */
    private function readLogs()
    {
        $logs = [];

        foreach ($this->fileSystem->glob(MAKO_APPLICATION_PATH . '/storage/logs/*.mako') as $key => $file) {
            if (is_file($file)) {
                $reader = new LogReader($file);

                if ($reader) {
                    $stdClass = new \stdClass();
                    $stdClass->file = $file;
                    $stdClass->date = \DateTime::createFromFormat('Y-m-d', basename($file, '.mako'));
                    $stdClass->message = '';

                    foreach ($reader as $log) {
                        if (isset($log['date']) && $log['date'] instanceof \DateTime) {
                            $stdClass->level = strtolower($log['level']);
                            $stdClass->message .= $log['date']->format('H:i:s') . ' - ' . $log['message'] . "\n\n";
                        }
                    }

                    $logs[substr(md5($file), 0, 8)] = $stdClass;
                }
            }
        }

        return new Collection($logs);
    }
}
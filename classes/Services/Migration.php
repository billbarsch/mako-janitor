<?php
namespace softr\MakoJanitor\Services;

use \StdClass;

use mako\file\FileSystem;
use mako\utility\Collection;
use mako\database\ConnectionManager;
use mako\syringe\Container;

use \softr\MakoSchemaBuilder\Schema;

/**
 * Migration janitor service.
 *
 * @author     Agência Softr Ltda
 * @copyright  (c) 2017
 */
class Migration
{
    /**
     * Container Instance.
     *
     * @var \mako\syringe\Container
     */
    protected $container;

    /**
     * Database connection.
     *
     * @var \mako\database\Connection
     */
    protected $connection;

    /**
     * File system instance.
     *
     * @var \mako\file\FileSystem
     */
    protected $fileSystem;

    /**
     * Constructor.
     *
     * @param  Container          $container   Container instance
     * @param  ConnectionManager  $connection  Connection Manager instance
     * @param  Schema             $schema      Schema builder instance
     * @param  FileSystem         $fileSystem  FileSystem instance
     */
    public function __construct(Container $container, ConnectionManager $connection, FileSystem $fileSystem)
    {
        $this->container = $container;

        $this->connection = $connection;

        $this->fileSystem = $fileSystem;

        $this->collection = $this->listMigrations();
    }

    /**
     * Return all migrations
     *
     * @access  public
     * @return  \mako\utility\Collection
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * Check if has pending migrations
     *
     * @access  public
     * @return  boolean
     */
    public function hasPending()
    {
        foreach ($this->collection->getItems() as $item) {
            if ($item->status == false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Order migrations in ascending order
     *
     * @return \mako\utility\Collection
     */
    public function asc()
    {
        $this->collection->sort(function($a, $b) {
            if ($a->version == $b->version) {
                return 0;
            }

            return $a->version < $b->version ? -1 : 1;
        });

        return $this;
    }

    /**
     * Order migrations in descending order
     *
     * @return \mako\utility\Collection
     */
    public function desc()
    {
        $this->collection->sort(function($a, $b) {
            if ($a->version == $b->version) {
                return 0;
            }

            return $a->version > $b->version ? -1 : 1;
        });

        return $this;
    }

    /**
     * Ler os logs do sistema
     *
     * @return  array
     */
    private function listMigrations()
    {
        $migrations = [];

        $files = glob(MAKO_APPLICATION_PATH . '/migrations/*.php');

        if (is_array($files)) {
            foreach ($files as $file) {
                $migration = new StdClass();

                $migration->version = basename($file, '.php');

                $migration->date = \DateTime::createFromFormat('YmdHis', preg_replace('/\D/', '', $migration->version));

                $migration->package = '';

                $migration->class = 'app\\migrations\\' . $migration->version;

                $migration->description = $this->container->get($migration->class)->description;

                $migration->status = $this->table()->where('version', '=', $migration->version)->count() > 0;

                $migrations[] = $migration;
            }
        }

        $packages = glob(MAKO_APPLICATION_PATH . '/packages/*');

        if (is_array($packages)) {
            foreach ($packages as $package) {
                if (is_dir($package)) {
                    $files = glob($package . '/migrations/*.php');

                    if (is_array($files)) {
                        foreach ($files as $file) {
                            $migration = new StdClass();

                            $migration->version = basename($file, '.php');

                            $migration->date = \DateTime::createFromFormat('YmdHis', preg_replace('/\D/', '', $migration->version));

                            $migration->package = basename($package);

                            $migration->class = '\\' . $migration->package . '\\migrations\\' . $migration->version;

                            $migration->description = $this->container->get($migration->class)->description;

                            $migration->status = $this->table()->where('version', '=', $migration->version)->count() > 0;

                            $migrations[] = $migration;
                        }
                    }
                }
            }
        }

        usort($migrations, function($a, $b) {
            return strcmp($a->version, $b->version);
        });

        return new Collection($migrations);
    }

    /**
     * Returns array of all outstanding migrations.
     *
     * @access  public
     * @return  array
     */
    public function getOutstanding()
    {
        $migrations = $this->listMigrations();

        foreach ($migrations as $key => $migration) {
            if ($migration->status) {
                $migrations->offsetUnset($key);
            }
        }

        return $migrations;
    }

    /**
     * Returns an array of migrations to roll back.
     *
     * @access  protected
     * @param   int        $batches  Number of batches to roll back
     * @return  array
     */
    protected function getBatch($batches = 1)
    {
        if ($batches > 0) {
            $this->table()->where('batch', '>', ($this->table()->max('batch') - $batches));
        }

        return $this->table()->select(['version', 'package'])->orderBy('version', 'desc')->all();
    }

    /**
     * Returns the number of outstanding migrations.
     *
     * @access  public
     */
    public function status()
    {
        return count($this->getOutstanding());
    }

    /**
     * Runs all outstanding migrations.
     *
     * @access  public
     */
    public function up()
    {
        $ran = [];

        $migrations = $this->getOutstanding();

        if (empty($migrations)) {
            return false;
        }

        $batch = $this->table()->max('batch') + 1;

        foreach ($migrations as $migration) {
            $this->container->get($migration->class)->up();

            $this->table()->insert(['batch' => $batch, 'package' => $migration->package, 'version' => $migration->version]);

            $name = $migration->version;

            if (!empty($migration->package)) {
                $name = $migration->package . '::' . $name;
            }

            $ran[] = $name;
        }

        return $ran;
    }

    /**
     * Rolls back the n last migration batches.
     *
     * @access  public
     * @param   int     $batches  Number of batches to roll back
     */
    public function down($batches = 1)
    {
        $rolled = [];

        $migrations = $this->getBatch($batches);

        if (empty($migrations)) {
            return false;
        }

        foreach ($migrations as $migration) {
            $this->container->get($migration->class)->down();

            $this->table()->where('version', '=', $migration->version)->delete();

            $name = $migration->version;

            if (!empty($migration->package)) {
                $name = $migration->package . '::' . $name;
            }

            $rolled[] = $name;
        }

        return $rolled;
    }

    /**
     * Rolls back all migrations.
     *
     * @access  public
     */
    public function reset()
    {
        $this->down(0);
    }

    /**
     * Returns a query builder instance.
     *
     * @access  private
     * @return  \mako\database\query\Query
     */
    private function table()
    {
        return $this->connection->builder()->table('mako_migrations');
    }
}
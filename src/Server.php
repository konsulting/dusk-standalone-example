<?php

namespace App;

use Symfony\Component\Process\Process;

class Server
{
    /** @var \Symfony\Component\Process\Process */
    protected $process;

    protected $host;
    protected $port;
    protected $script = __DIR__.'/front_controller.php';

    public function __construct($host = '127.0.0.1', $port = 8000)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function setFrontController($script = null)
    {
        $this->script = $script ?: __DIR__.'/front_controller.php';

        return $this;
    }

    public function start()
    {
        if ($this->process) {
            return;
        }

        $script = basename($this->script);
        $root = dirname($this->script);

        $this->process = new Process("exec php -S {$this->host}:{$this->port} {$script}");
        $this->process->setWorkingDirectory($root);
        $this->process->disableOutput();
        $this->process->start();

        // This is to ensure we don't get servers left over when a script
        // terminates early, e.g. die() in the middle of a test.
        register_shutdown_function(function () {
            $this->stop();
        });
    }

    public function stop()
    {
        if (! $this->process || ! $this->process->isRunning()) {
            return;
        }

        $this->process->stop();
    }
}

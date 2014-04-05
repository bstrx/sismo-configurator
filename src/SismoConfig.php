<?php
class SismoConfig
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $repository;

    /**
     * @var string
     */
    private $branch;

    /**
     * @var array
     */
    private $commands = [];

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $urlPattern;

    /**
     * @var string
     */
    private $notifier;

    public function __construct($name, $repository)
    {
        $this->name = $name;
        $this->repository = $repository;
    }

    /**
     * @param string $branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @param array $commands
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;
    }

    /**
     * @param array $command
     */
    public function addCommand($command)
    {
        $this->commands[] = $command;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $notifier
     */
    public function setNotifier($notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * @return string
     */
    public function getNotifier()
    {
        return $this->notifier;
    }

    /**
     * @param string $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $urlPattern
     */
    public function setUrlPattern($urlPattern)
    {
        $this->urlPattern = $urlPattern;
    }

    /**
     * @return string
     */
    public function getUrlPattern()
    {
        return $this->urlPattern;
    }

    /**
     * @param $path
     */
    public function saveConfigOnDisk($path)
    {
        $content = $this->getContent();
        file_put_contents($path, $content);
    }

    /**
     * @return string
     */
    private function getContent()
    {
        $glue = ';' . PHP_EOL . '    ';
        $commands = implode($glue, $this->commands);

        $name = $this->name;
        $repository = $this->repository;
        $branch = $this->branch;
        $slug = $this->slug;
        $urlPattern = $this->urlPattern;
        $notifier = $this->notifier;

        ob_start();
        require('template.php');

        return ob_get_clean();
    }
}

<?php

namespace Fansible\DevopsBundle\Generator\Helper;

class TwigHelper
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var string
     */
    protected $provisioningPath;

    /**
     * @param \Twig_Environment $twig
     * @param string            $rootDir
     * @param string            $provisioningPath
     */
    public function __construct($twig, $rootDir, $provisioningPath)
    {
        $this->twig = $twig;
        $this->rootDir = $rootDir;
        $this->provisioningPath = $provisioningPath;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function getTwigPath($path)
    {
        return 'FansibleDevopsBundle:' . $path;
    }

    /**
     * @param string $fileName
     * @param string $twigFile
     * @param array  $parameters
     */
    public function render($fileName, $twigFile, $parameters = [])
    {
        if (!is_dir(dirname($fileName))) {
            mkdir(dirname($fileName), 0777, true);
        }

        file_put_contents($fileName ,$this->twig->render($this->getTwigPath($twigFile), $parameters));
    }

    /**
     * @param string $fileName
     * @param string $twigFile
     * @param array  $parameters
     */
    public function renderProvisioningFile($fileName, $twigFile, $parameters = [])
    {
        $this->render($this->provisioningPath . $fileName, $twigFile, $parameters);
    }
}

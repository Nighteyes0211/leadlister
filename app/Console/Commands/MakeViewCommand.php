<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

class MakeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cview {view} {user} {--L|layout=dashboard.app} {livewire=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates view';


    /**
     * Folders
     *
     * @var array
     */
    private $folders = [
        'org' => 'resources/views/users/organization',
        'guest' => 'resources/views/users/guest',
    ];

    /**
     * Dashboard folder path
     *
     */
    public function getDashboardPath(string $dashboard){
        return $this->folders[$dashboard];
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($view)
    {
        return ucwords(Pluralizer::singular($view));
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return __DIR__ . '/../../../stubs/view.stub';
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables()
    {
        $title = Str::replace('.', ' ', $this->argument('view'));
        $title = Str::lower($title);
        $title = Str::ucfirst($title);

        return [
            'LAYOUT'  => $this->option('layout'),
            'TITLE'   => $title,
            'COMPONENT' => 'users.' . $this->argument('user') . '.' . $this->argument('view')
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    /**

     * Get the view full path.

     *

     * @param string $view

     *

     * @return string

     */

    public function viewPath($view)

    {

        $view = str_replace('.', '/', $view) . '.blade.php';


        $dashboard  = $this->getDashboardPath($this->argument('user'));


        $path = "{$dashboard}/{$view}";


        return $path;

    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $view = $this->argument('view');



        $path = $this->viewPath($view);



        $this->createDir($path);



        if (File::exists($path))

        {

            $this->error("File {$path} already exists!");

            return;

        }

        $contents = $this->getSourceFile();


        File::put($path, $contents);

        // if ($this->argument('livewire')) {
        //     Artisan::call('make:clivewire', ['view' => $view, 'user' => $this->argument('user')]);

        //     $livewirePath = Str::before($path, ".");
        //     $livewirePath = Str::after($livewirePath, "resources/views/");
        //     $livewirePath = Str::lower($livewirePath);
        //     $livewirePath = Str::replace('/', '.', $livewirePath);

        //     $this->info("livewire path: $livewirePath");

        // }
        // Artisan::call("livewire:make", ['name' => $livewirePath]);

        $this->info("File {$path} created.");




        return Command::SUCCESS;
    }
}

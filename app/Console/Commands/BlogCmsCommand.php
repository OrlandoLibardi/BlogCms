<?php
namespace OrlandoLibardi\BlogCms\app\Console\Commands;
use Illuminate\Console\Command;

class BlogCmsCommand extends Command{
   /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BlogCms:install';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aciona o service provider para copiar os arquivos e após isso remove os arquivos base.';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->confirm('Copiar os arquivos?') ){
            $this->call('vendor:publish', ['--provider' => 'OrlandoLibardi\BlogCms\app\Providers\OlCmsBlogServiceProvider', '--tag' => 'config']);
            $this->call('vendor:publish', ['--provider' => 'OrlandoLibardi\BlogCms\app\Providers\OlCmsBlogServiceProvider', '--tag' => 'public']);        
            $this->info('Copiados!');
        }

        $base = [
            __DIR__ . '/../../../resources/',
            __DIR__ . '/../../../public/',
            __DIR__ . '/../../../database/',
        ];
        
        if($this->confirm('Apagar os arquivos, originais na pasta vendor?')) { 

            foreach ($base as $b){
               $this->getDirContents($b);
            }

        }

        return 0;
    }

    public function getDirContents($dir){

        $files = scandir($dir);
    
        foreach($files as $key => $value){  

            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

            if(!is_dir($path)) {

                @unlink( $path );               
            } 
            else if($value != "." && $value != "..") {
                $this->getDirContents($path);

            }
        }   
    }
}
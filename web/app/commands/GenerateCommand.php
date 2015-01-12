<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gen:school';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'generate service Class';

    protected $appPaths = array();
    protected $actions = array(
        'get'       => array('get', 'select'), 
        'add'       => array('set', 'insert'), 
        'remove'    => array('set', 'delete'), 
        'modify'    => array('set', 'update'), 
        'is'        => array('', 'select')
    );

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()/*{{{*/
	{
		parent::__construct();

        $conf = include("bootstrap/paths.php");
        $this->appPaths    = array(
            'app'      => $conf['app'],
            'template'      => $conf['app'].'/commands/generate/',
            'controller'    => $conf['app'].'/controllers/',
            'service'       => $conf['app'].'/lib/service/',
            'servicedao'    => $conf['app'].'/lib/dao/',
            'model'         => $conf['app'].'/models/',
        );
	}/*}}}*/

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()/*{{{*/
	{
        $type = strToLower($this->argument('type'));

        if($type == 'service')
            $this->service();
        else if($type == 'model')
            $this->model();
        else
            $this->method($type);

        echo "\n";
	}/*}}}*/

    private function service()/*{{{*/
    {
        $name = ucFirst( strToLower($this->argument('name')) );

        $this->comment("generated service files...");
        $rCtrl  = $this->makeService($name, 'Controller');
        $rSvc   = $this->makeService($name, 'Service');
        $rDao   = $this->makeService($name, 'ServiceDao');

        if($rCtrl)  $this->info("[OK] make app/controllers/{$name}Controller.php");
        if($rSvc)   $this->info("[OK] make app/lib/service/{$name}Service.php");
        if($rDao)   $this->info("[OK] make app/lib/dao/{$name}ServiceDao.php");
        exit;
    }/*}}}*/

    private function model()/*{{{*/
    {
        $name = ucFirst( strToLower($this->argument('name')) );

        $template   = $this->appPaths['template'].'Model.php';
        $target     = $this->appPaths['model'].$name.'.php';
        $path       = 'app'.str_replace($this->appPaths['app'], "", $target);

        if(File::exists($target)){
            $this->error("[ERROR] model File is Already :".$path);
            return false;
        }

        $contents = File::get($template);
        $contents = preg_replace("@{{name}}@ims", $name, $contents);


        $isDisplay = $this->option('d');
        if($isDisplay){
            $this->info($path);
            echo $contents;
        }else{
            $r     = File::put($target, $contents);
            if(!$r){
                $this->error("[ERROR] {$type} File make failed : $path");
            }else{
                $this->info("[OK] make ".$path);
            }

        }
    }/*}}}*/

    public function method($serviceName)/*{{{*/
    {
        $method = $this->argument('name');
        $keys = array_keys($this->actions);
        $key = implode("|", $keys);
        if( !preg_match("@^({$key})@ims", $method) ){
            $this->error("Not Allow Method Prefix Name : allows(get, add, remove, modify, is)");
            exit;
        }

        foreach($this->actions as $key=>$val){
            if( preg_match("@^{$key}@", $method) ){
                if($val[0])
                    $ctrlMethod = preg_replace("@^{$key}@", $val[0], $method);
                else
                    $ctrlMethod = '';

                $svcMethod  = $method;
                $daoMethod  = preg_replace("@^{$key}@", $val[1], $method);

                break;
            }
        }
        $serviceName = ucFirst($serviceName);
        $names = array(
            'controller_class'  => $serviceName.'Controller',
            'service_class'     => $serviceName.'Service',
            'dao_class'         => $serviceName.'ServiceDao',
            'controller_method' => $ctrlMethod,
            'service_method'    => $svcMethod,
            'dao_method'        => $daoMethod,
        );

        $ctrl       = $this->getMethod($names, $method, 'controller');
        $service    = $this->getMethod($names, $method, 'service');
        $dao        = $this->getMethod($names, $method, 'dao');

        $this->makeMethod($serviceName, $ctrl, 'Controller');
        $this->makeMethod($serviceName, $service, 'Service');
        $this->makeMethod($serviceName, $dao, 'ServiceDao');
    }/*}}}*/


    public function getMethod($names, $method, $type)/*{{{*/
    {
        if($type == 'controller' && !$names['controller_method'])
            return '';

        $mType = 'm'.ucFirst( strToLower($type) );
        $template   = $this->appPaths['template'].$mType.'.php';
        $content = trim(File::get($template));

        foreach($names as $k=>$v){
            $content = str_replace('{{'.$k.'}}', $v, $content);
        }
        return array(
            'name'      => $names[$type.'_method'],
            'content'   => "\n\n    ".$content."\n",
        );
    }/*}}}*/

    public function makeMethod($class, $data, $type)/*{{{*/
    {
        if(!$data) return true;
        $target     = $this->appPaths[ strToLower($type) ].$class.$type.'.php';
        $path       = 'app'.str_replace($this->appPaths['app'], "", $target);

        if(!File::exists($target)){
            $this->error("[ERROR] {$type} file Not Found :".$path);
            return false;
        }

        $text = trim(File::get($path));
        if(!$text){
            $this->error("[ERROR] empty Content. :".$path);
            return false;
        }
        $isAlready = false;
        if( preg_match("@function\s{$data['name']}@im", $text) ){
            $isAlready = true;
        }


        $texts = explode("\n", $text);
        $len    = sizeof($texts);
        $i      = 1;
        while(true){
            $line = $texts[ $len-$i ];
            if(strstr($line, '}')){
                $split = $len-$i; 
                break;
            }

            if($i > 100) break;
            $i++;
        }

        $t = array_chunk($texts, $split);
        $text   = implode("\n", $t[0]).$data['content'].implode("\n", $t[1]);

        $isDisplay = $this->option('d');
        if($isDisplay){
            $this->info("{$path}::{$data['name']}");
            echo $data['content'];
        }elseif($isAlready){
            $this->error("[ERROR] Already exists Method : {$path}::{$data['name']}");
            echo $data['content'];
        } else {
            $r     = File::put($target, $text);
            if(!$r){
                $this->error("[ERROR] File update failed : $path");
            }
        }
    }/*}}}*/

    private function makeService($name, $type)/*{{{*/
    {
        $template   = $this->appPaths['template'].$type.'.php';
        $target     = $this->appPaths[ strToLower($type) ].$name.$type.'.php';
        $path       = 'app'.str_replace($this->appPaths['app'], "", $target);

        if(File::exists($target)){
            $this->error("[ERROR] {$type} File is Already :".$path);
            return false;
        }

        $contents = File::get($template);
        if(!$contents){
            $this->error("[ERROR] {$type} Template File Not Found. :".$template);
            return false;
        }

        $r  = false;
        $isDisplay = $this->option('d');
        if($isDisplay){
            $this->info($path);
            echo $contents;
        }else{
            $contents = preg_replace("@{{name}}@ims", $name, $contents);
            $r     = File::put($target, $contents);
            if(!$r){
                $this->error("[ERROR] {$type} File make failed : $path");
            }
        }

        return $r;
    }/*}}}*/

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('type', InputArgument::REQUIRED, 'Generate Type(service, classNames..)'),
			array('name', InputArgument::REQUIRED, 'Service Name'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('d', null, InputOption::VALUE_OPTIONAL, 'No make file And generate code Display', null),
		);
	}

}

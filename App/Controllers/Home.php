<?php

namespace App\Controllers;

use \Core\View;
use \App\Request;
use \App\Component;
use \App\Template;

/**
 * Home controller
 *
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */

    
    public function indexAction()
    {
        
        $components = Component::getAll();
        View::renderTemplate('Home/index.html',[
            'components' => $components,
        ]); 

        
    }

    public function renderAction(){

        $components = json_decode($_POST['components']);

        if(count($components) !== 0){
            View::renderTemplate('templates/components.html',[
                'components' => $components,
            ]);
        }

    }

    public function saveTemplateAction(){
        
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/templates/template". date("Y-m-d-h-i-s") .".json","wb");
        fwrite($fp,$_POST['components']);
        fclose($fp);

        $response['templates'] = Template::getAll();

        echo json_encode($response);

    }

    public function openTemplateAction(){
        

        $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/templates/".$_POST['template'], "r") or die("Unable to open file!");
        $response['components'] = json_decode(fread($myfile,filesize($_SERVER['DOCUMENT_ROOT'] . "/templates/".$_POST['template'])));
        fclose($myfile);

        
        if(count($response['components']) !== 0){
            View::renderTemplate('templates/components.html',[
                'components' => $response['components'],
            ]);
        }
        

    }

    public function getComponentsAction() {

        $response['components'] = Component::getAll();

        
        echo json_encode($response);
    }

    public function getTemplatesAction() {

        $response['templates'] = Template::getAll();

        
        echo json_encode($response);
    }

    
    
}

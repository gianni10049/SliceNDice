<?php

namespace Libraries;

use Libraries\Security;
use Libraries\Enviroment;
use Database\DB;

/**
 * @class Template
 * @package Controllers
 * @note Class for create templating of pages
 */
class Template
{
    /**
     * Init vars PUBLIC
     * @var string $folder
     */
    public
        $folder;

    /**
     * Init vars PRIVATE
     * @var string $sec
     */
    private
        $sec,
        $env,
        $db;

    /**
     * @fn __construct
     * @note Template constructor.
     * @param string $folder
     * @return void
     */
    public function __construct(string $folder = null)
    {
        #Init needed classes
        $this->sec = Security::getInstance();
        $this->env = Enviroment::getInstance();
        $this->db = DB::getInstance();

        #If folder is specified set folder, else set default folder for views
        (!is_null($folder)) ? $this->SetFolder($folder) : $this->folder = $this->sec->Filter(VIEWS, 'String');
    }

    /**
     * @fn SetFolder
     * @note Set new folder for template object
     * @param string $folder
     * @return Template
     */
    public function SetFolder(string $folder): Template
    {
        #Set new folder
        $this->folder = $this->sec->Filter($folder, 'String');

        #Return Template object
        return $this;
    }

    /**
     * @fn Render
     * @note Render view
     * @param array $variables
     * @return bool|string
     */
    public function Render( array $variables = [])
    {
        #Find template
        $template = $variables['Page'];

        #If template exist render template else return false
        echo ($template !== false) ? $this->RenderTemplate($template, $variables) : false;
    }

    /**
     * @fn GetVars
     * @return string
     * @var string $template
     * @var array $vars
     */
    public function RenderTemplate(string $template, array $vars): string
    {
        #Start output
        ob_start();

        #Foreach var
        foreach ($vars as $key => $value) {

            #Set values like post var
            $_POST[$key] = $value;
        }

        $_POST['body'] = $this->ExtractText($template);

        #Load template
        require(ROOT.'/public/theme/body.php');

        #Return output for echo
        return ob_get_clean();
    }

    public function MenuList(){
        return $this->db->Select('*','menu',"active='1' AND father_id='0'")->FetchArray();
    }

    public function MenuHaveSub($id){

        $id= $this->sec->Filter($id,'Int');

        $contr = $this->db->Count('menu',"father_id='{$id}' AND active='1'");

        return ($contr > 0);
    }

    public function SubMenuList($father){

        $father= $this->sec->Filter($father,'String');

        return $this->db->Select('*','menu',"active='1' AND father_id='{$father}' ORDER BY text")->FetchArray();
    }

    public function ExtractText($alias){

        $alias = $this->sec->Filter($alias,'String');

        $data = $this->db->Select("content,title,page_link",'routes',"alias='{$alias}'")->Fetch();

        $title= $this->sec->Filter($data['title'],'String');

        if(is_null($data['page_link'])){
            $content = $this->sec->HtmlFilter($data['content']);
            $is_link = false;
        }
        else{
            $content=$this->sec->Filter($data['page_link'],'String');
            $is_link = true;
        }

        return ['text'=>$content,'is_link'=>$is_link,'title'=>$title];

    }

    public function ExecuteAjax($args){

        $alias = $this->sec->Filter($args['Page'],'String');

        $data= $this->db->Select('page_link','routes',"alias='{$alias}'")->Fetch();

        $page = $this->sec->Filter($data['page_link'],'String');

        require ROOT.'/public/theme/Ajax'.$page;

    }
}
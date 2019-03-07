<?php

namespace OrlandoLibardi\BlogCms\app\Providers;

use BadMethodCallException;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;

use OrlandoLibardi\BlogCms\app\Blog;
use OrlandoLibardi\BlogCms\app\BlogCategory;
use OrlandoLibardi\BlogCms\app\BlogComment;

class OlCmsBlogBuilder
{
    
    protected $defaults;
    protected $accepted = ['offset', 'limit', 'paginate', 'categories', 'template', 'exclude', 'id'];
    protected $params;


    public function __construct()
    {
        $this->defaults = config('blog');

    }
    
    public function show()
    {
       
    }

    public function commentList($id=false)
    {
        if(!$id) return false;
        $this->setVars(['id' => $id]);
        $comments = BlogComment::approved()
                                ->comments($id)
                                ->get();

        return view($this->params['template_comment_list'], compact('comments'));                     
    }

    public function commentForm($id=false)
    {        
        if(!$id) return false;
        $this->setVars(['id' => $id]);
        return view($this->params['template_comment_form'], compact('id'));
    }

    /**
     * Details
     */

     public function detail(array $params = [])
     {
        $this->setVars($params);
        $item = Blog::where('alias', $this->params['alias'])
                      ->active()
                      ->get();
        
        return view($this->params['template_details'], compact('item'));  
     }
    /**
     * Related
     */
    public function related(array $params = [])
    {
        $this->setVars($params);
       
        if(!$this->params['exclude']) return false;

        if(!empty($this->params['categories']))
        {       
            $items = Blog::categorie( $this->params['categories'] )
                            ->where('id', "!=", $this->params['exclude'])
                            ->offset($this->params['offset'])
                            ->limit($this->params['limit'])
                            ->get();
        }
        else
        {
            $items = Blog::active()
                          ->where('id', "!=", $this->params['exclude'])
                          ->offset($this->params['offset'])
                          ->limit($this->params['limit'])
                          ->get();
        }

        return view($this->params['template_related'], compact('items'));

    }

    /**
     * Categories
     */
    public function category(array $params = [])
    {
        $this->setVars($params);
        if(!$this->params['categories'])
        { 
            $items = BlogCategory::all();

        }else
        {
            $items = BlogCategory::whereIn('id', $this->params['categories'])->get();
        }

        return view($this->params['template_category'], compact('items'));
    }
    /**
     * Featured
     */
    public function featured()
    {
        $this->setVars();
        $items = Blog::featured()->active()->get();
        return view($this->params['template_summary'], compact('items'));
    }
    /**
     * Summary
     */
    public function summary(array $params = [])
    {
       
        $this->setVars($params);
        /* Sem categorias */
        if(!$this->params['categories'])
        {   
            /* com paginação */
            if($this->params['paginate'])
            {
                $items = $this->summaryPaginate();
            }
            else
            {
                /* sem paginação */
                $items = $this->summaryGet();
            }
            
        }
        /* com paginação */
        else if($this->params['paginate'])
        {
            $items = $this->summaryCategoriePaginate();
        }
        else
        {
            /* sem paginação */
            $items = $this->summaryCategorieGet();
        }
        

        return view($this->params['template_summary'], compact('items'));

    }

    /**
     * Com categorias e paginação
     */
    public function summaryCategoriePaginate()
    {
        return Blog::categorie( $this->params['categories'] )
                ->paginate($this->params['paginate']);
    }
    /**
     * Com categorias sem paginação
     */
    function summaryCategorieGet()
    {
        return Blog::categorie( $this->params['categories'] )
                ->offset($this->params['offset'])
                ->limit($this->params['limit'])
                ->get();  
    }
    /**
     * Sem categorias sem paginação
     */
    function summaryGet()
    {
        return Blog::active()
                ->offset($this->params['offset'])
                ->limit($this->params['limit'])
                ->get();                
    }
    /**
     * Sem categorias com paginação
     */
    public function summaryPaginate()
    {
        return Blog::active()
                ->paginate($this->params['paginate']); 
    }

    /**
     * Set params
     */
    public function setParams($params)
    {
        $this->params = new Collection($params);
    }
    /**
     * set vars
     */
    public function setVars(array $params = [])
    {                
        if(count($params) > 0 )
        {   
            $dados = $this->checkVars($params);                   
            
            foreach($this->defaults as $key=>$value)
            {
                if(!array_key_exists($key, $dados))
                {
                    $dados[$key] = $value; 
                }
            }

            return $this->setParams($dados);
        }
        
        return $this->setParams($this->defaults);
         
    }
    /**
     * Check values 
     */
    public function checkVars(array $params = [])
    {
        $dados = [];
        foreach($params as $key=>$value)
        {
            if(in_array($key, $this->accepted)){
                $dados[$key] = $params[$key];
            }
        }   

        return $dados;
    }
}
<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OrlandoLibardi\BlogCms\app\Blog;
use OrlandoLibardi\BlogCms\app\BlogCategory;

class BlogShowController extends Controller
{
    protected $alias;  
    protected $categorie;
    protected $blog;
    protected $term;
    protected $temp;

    /**
     * 
     */
    public function __construct(Request $request)
    {
        $this->alias = (isset($request->alias)) ? $request->alias : false;
        $this->setTemp();
       
    }
    /**
     * 
     */
    public function index()
    {
        return $this->resolveMethod();
    }
    /**
     * Decide qual methodo mostrar
     */
    public function resolveMethod()
    {

        if($this->isSearch())
        {
            return  $this->search();
        }
        
        if($this->isCategorie())
        {
            return $this->category();
           
        }

        if($this->isPostage())
        {
            return $this->postage();
        }

        return view(config('blog.page_default'));

        //return abort(404);        
    }
    /**
     * monta um array com os dados da url fornecido 
     */
    public function setTemp()
    {
        if(!$this->alias) return false;
        $this->temp = explode("/", $this->alias);
    }

    public function isSearch()
    {
        if($this->temp[0] == 'search')
        {
            if(!isset($this->temp[1])) return false;
            $this->term = $this->temp[1];
            return $this->term;
        }

        return false;
    }
    /**
    * Busca postagens pelo termo fornecido
    */
    public function search()
    {
        if(!$this->term) return false;
        $items = Blog::search($this->term)
                 ->get();
        return view(config('blog.page_search'), compact('items'));
    }
    /**
     * Exibe resultados de uma categoria
     */
    public function category()
    {
        if(!$this->categorie) return false;
        $items = Blog::categorie([$this->categorie->id])
                 ->paginate(10);

        $category = $this->categorie->name;         
        
        return view(config('blog.page_categorie'), compact('items', 'category'));
    }
    /**
    * Verifica se uma categoria existe 
    */
    public function isCategorie()
    {
        $this->categorie = BlogCategory::where("alias", $this->temp[0])
                           ->first(); 
        return $this->categorie;        
    }
    /**
     * Exibe uma postagem
     */
    public function postage()
    {
        if(!$this->blog) return false;
        $item = $this->blog;
        return view(config('blog.page_details'), compact('item'));
    }
    /**
     * Verifica se a postagem existe
     */
    public function isPostage()
    {
        $this->blog = Blog::active()
                      ->where('alias', $this->temp[0])
                      ->first();
        return $this->blog;
    }

    

}

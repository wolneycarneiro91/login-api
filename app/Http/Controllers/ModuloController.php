<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\ModuloRequest;
use App\Models\Modulo;

class ModuloController extends Controller
{
    protected $modulo;
    public function __construct(Modulo $modulo){
            $this->modulo = $modulo;        
    } 
    public function index(Request $request)
    {    
        if ($request->filled('limit')) {
            if ($request->limit == '-1') {
                $data = $this->modulo->get();
            }
        } else {
            $data = $this->modulo->paginate(config('app.pageLimit'));
        }                                     
        $data = $this->modulo->all();
        return response()->json($data, Response::HTTP_OK );                
    }
    public function store(ModuloRequest $request)
    {   
        //dd('fsdfd');        
        $dataFrom = $request->all();
        
        DB::beginTransaction();
        try {        
            $data = $this->modulo->create($dataFrom);  
            DB::commit(); 
            return response()->json($data,Response::HTTP_CREATED ) ;
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json('Não foi possível cadastrar'.$e, Response::HTTP_NOT_ACCEPTABLE );
        }             
    }
    public function show($id)
    {
        $data = $this->modulo->find($id);
        if(!$data){
            return response()->json(['error'=>'Dados não encontrados'],Response::HTTP_NOT_FOUND) ;
        }
        return response()->json($data,Response::HTTP_OK ) ;
    }
    public function update(ModuloRequest $request, $id)
    { 
        $data = $this->modulo->find($id);  
        if(!$data){
            return response()->json(['error'=>'Dados não encontrados'],Response::HTTP_NOT_FOUND) ;
        }            
        $dataFrom = $request->all();
        DB::beginTransaction();
        try {          
            $data->update($dataFrom);  
            DB::commit(); 
            return response()->json($data,Response::HTTP_OK ) ;    
            }
        catch (\Exception $e)
             {
             DB::rollback();
             return response()->json(["message"=>'Não foi possível atualizar',"error"=>$e], Response::HTTP_NOT_ACCEPTABLE );
            }                             
    }

    public function destroy($id)
    {
        $data = $this->modulo->find($id);
        if(!$data){
            return response()->json(['error'=>'Dados não encontrados'],Response::HTTP_NOT_FOUND) ;
        }
         DB::beginTransaction();
         try {  
                $data->delete();
                DB::commit(); 
                return response()->json(['success'=>'Deletado com sucesso.'],Response::HTTP_OK ) ; 
         }
        catch (\Exception $e)
             {
                DB::rollback();
                return response()->json(["message"=>'Não foi possível excluir',"error"=>$e], Response::HTTP_NOT_ACCEPTABLE );
            }                
    }    
    
}

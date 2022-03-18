<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\SistemaRequest;
use App\Models\Sistema;

class SistemaController extends Controller
{
    protected $sistema;
    public function __construct(Sistema $sistema){
            $this->sistema = $sistema;        
    } 
    public function index(Request $request)
    {    
        if ($request->filled('limit')) {
            if ($request->limit == '-1') {
                $data = $this->sistema->get();
            }
        } else {
            $data = $this->sistema->paginate(config('app.pageLimit'));
        }                                     
        $data = $this->sistema->all();
        return response()->json($data, Response::HTTP_OK );                
    }
    public function store(SistemaRequest $request)
    {        
        $dataFrom = $request->all();
        DB::beginTransaction();
        try {        
            $data = $this->sistema->create($dataFrom);  
            DB::commit(); 
            return response()->json($data,Response::HTTP_CREATED ) ;
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>'Não foi possível cadastrar',"error"=>$e], Response::HTTP_NOT_ACCEPTABLE );
        }             
    }
    public function show($id)
    {
        $data = $this->sistema->find($id);
        if(!$data){
            return response()->json(['error'=>'Dados não encontrados'],Response::HTTP_NOT_FOUND) ;
        }
        return response()->json($data,Response::HTTP_OK ) ;
    }
    public function update(SistemaRequest $request, $id)
    { 
        $data = $this->sistema->find($id);  
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
        $data = $this->sistema->find($id);
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

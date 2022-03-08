<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function __construct(User $user){
            $this->user = $user;        
    } 
    public function index()
    {                           
        $data = $this->user->all();
        return response()->json($data, 201);                
    }
    public function store(UserRequest $request)
    {        
        $this->validate($request, $request->rules());   
        $dataFrom = $request->all();
        $dataFrom['password'] = bcrypt($dataFrom['password'])  ;    
        $user_key = Uuid::uuid4();       
        $dataFrom['user_key'] = $user_key;
        DB::beginTransaction();
        try {        
            $data = $this->user->create($dataFrom);  
            DB::commit(); 
            return response()->json($data['name'].' Criado com sucesso',201) ;
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json('Não foi possível cadastrar'.$e, 406);
        }             
    }
    public function show($id)
    {
        $data = $this->user->find($id);
        if(!$data){
            return response()->json(['error'=>'Nada foi encontrado'],404) ;
        }
        return response()->json($data,201) ;
    }
    public function update(UserRequest $request, $id)
    { 
        $data = $this->user->find($id);  
        if(!$data){
            return response()->json(['error'=>'Nada foi encontrado'],404) ;
        } 
        $this->validate($request, $request->rules());    
        $dataFrom = $request->all();
        DB::beginTransaction();
        try {          
            $data->update($dataFrom);  
            DB::commit(); 
            return response()->json($data['name'].' Atualizado com sucesso',201) ;
            }
        catch (\Exception $e)
             {
             DB::rollback();
             return response()->json('Não foi possível atualizar', 406);
            }                             
    }

    public function destroy($id)
    {
        $data = $this->user->find($id);
        if(!$data){
            return response()->json(['error'=>'Nada foi encontrado'],404) ;
        }
         DB::beginTransaction();
         try {  
                $data->delete();
                DB::commit(); 
                return response()->json(['success'=>'Deletado com sucesso.'],201) ; 
         }
        catch (\Exception $e)
             {
                DB::rollback();
                return response()->json('Não foi possível excluir', 406);
            }                
    }    
    
}

<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new class instance.
    */
    public function __construct(private UserRepository $UserRepository)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // https://example.com?like=name,meh
    {
        try {
            if(!$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id)->hasPermission('view-users')){
                return ApiResponseClass::sendError('Unauthorized', 403);
            }
            $Users=$this->UserRepository->index();
            return ApiResponseClass::sendResponse($Users, 'All Users retrieved successfully.');
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error retrieving Users: ' . $e->getMessage());
        }

    }
   
    /**
     * Display the specified resource.
     */
    public function show($id,Request $request)
    {
        try{
            if(!$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id)->hasPermission('view-user')){
                return ApiResponseClass::sendError('Unauthorized', 403);
            }
            $user = $this->UserRepository->getById($id);
            $permissions = $user->allPermissions()->pluck('display_name', 'name')->toArray();
            $result= $result=['user' => $user, 'permissions' => $permissions];
            return ApiResponseClass::sendResponse($result, " data getted  successfully");
        }catch(Exception $e)
        {
            return ApiResponseClass::sendError('Error returned User: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['sometimes', 'string', 'max:255'],
                'whatsapp_number'=>['sometimes','string','max:16','regex:/^[0-9]+$/'],
                'contact_number'=>['sometimes','string','max:16','regex:/^[0-9]+$/'],
                'image'=>['sometimes','image','max:2048']
            ]);
            if ($validator->fails())
                return ApiResponseClass::sendValidationError($validator->errors()
            );
            $user_id=PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
            if($id !=  $user_id){
                return ApiResponseClass::sendError('Unauthorized',[],403);
            }
            $validatedData = $validator->validated();
            $user=$this->UserRepository->update($validatedData,$user_id);
            return ApiResponseClass::sendResponse($user, "{$user->username} updated successfully.");
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error Update User: ' . $e->getMessage());
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Request $request)
    {
        try {
            if(!$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id)->hasPermission('destroy-user')){
                return ApiResponseClass::sendError('Unauthorized', 403);
            }
            $User=$this->UserRepository->getById($id);
            if($this->UserRepository->delete($User->id)){
                return ApiResponseClass::sendResponse($User, "{$User->id} unsaved successfully.");
            }
            return ApiResponseClass::sendError("User with ID {$id} may not be found or not deleted. Try again.");
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error deleting User: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request){
        try {
            $validator=Validator::make($request->all(),[
                'old_password'=>['required'],
                'password'=>['required', 'string', 'min:8','confirmed'],
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user=$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id);
            $result=$this->UserRepository->changePassword($request->all(),$user);
            if($result){
                PersonalAccessToken::findToken($request->bearerToken())->delete();
                return ApiResponseClass::sendResponse(null," {$user->id} password has been changed.. Login again ",);
            }
            return ApiResponseClass::sendError('the password is incorrect');
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error change Password: ' . $e->getMessage());
        }
        
    }

    public function assignRole(Request $request, $user_id){
        try {
            if(!$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id)->hasPermission('assignRole')){
                return ApiResponseClass::sendError('Unauthorized', 403);
            }
            $validator = Validator::make($request->all(), [
                'role' => ['required','string',Rule::exists('roles','name')]
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $roles=$this->UserRepository->assignRole($user_id,$request->role);
            return ApiResponseClass::sendResponse(['roles'=>$roles]," {$request->role} Role assigned successfully. ",);

            
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error User Not Found: ' . $e->getMessage());
        }
    }

    public function revokeRole(Request $request, $user_id) {
        try {
            if (!$this->UserRepository->getById(PersonalAccessToken::findToken($request->bearerToken())->tokenable_id)->hasPermission('revokeRole')) {
                return ApiResponseClass::sendError('Unauthorized', 403);
            }
            $validator = Validator::make($request->all(), [
                'role' => ['required', 'string', Rule::exists('roles', 'name')]
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $roles = $this->UserRepository->revokeRole($user_id, $request->role);
            return ApiResponseClass::sendResponse(['roles' => $roles], "The role {$request->role} has been successfully revoked.");
        } catch (Exception $e) {
            return ApiResponseClass::sendError('Error User Not Found: ' . $e->getMessage());
        }
    }

}

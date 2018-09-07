<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {       
        return view('backend.auth.user.index')
            ->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }

    public function officer_create_user()
    {
        return view('backend.auth.user.officer_create_user');
            
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        return view('backend.auth.user.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {        
        $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'phone',
            'email',
            'password',
            'timezone',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }

    public function officer_user()
    {
        $users = User::where('officer_id',Auth::user()->id)->paginate(15);
        return view('backend.auth.user.officer_user', compact('users'));
    }


    public function officer_store_user(Request $request)
    {
        $this->validate($request, [
            'first_name'     => 'required|max:191',
            'last_name'  => 'required|max:191',
            'email'    => ['required', 'email', 'max:191', Rule::unique('users')],
            'timezone' => 'required|max:191',
            'password' => 'required|min:6|confirmed',
        ]);

        $words = preg_split("/\s+/", ($request->get('first_name').' '.$request->get('last_name')));
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        $six_digit_random_number = mt_rand(100000, 999999);
        $code = mt_rand(100000, 999999);
        
        User::insert([
            "uuid" => "87536hjgjhfh758356hfbjs",
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "phone"  => $request->get('phone'),
            "email" => $request->get('email'),
            'ac_number' => strtoupper($acronym) .$six_digit_random_number,
            'password' => Hash::make($request->get('password')),
            "timezone" => $request->get('timezone'),
            "active" => isset($request->active) && $request->active == '1' ? 1 : 0,
            "confirmed" => "1",
            'confirmation_code' =>  $code,
            'officer_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);         
       
        return redirect()->route('admin.dashboard')->withFlashSuccess(__('alerts.backend.users.created'));
    }


    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        dd('edit');
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'email',
            'timezone',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
}

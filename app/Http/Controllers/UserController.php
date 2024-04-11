<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $users = User::query()->orderBy('name')->orderBy('last_name')->get()->toArray();
        
        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($users);

        return view('user.index')->with(['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'password' => Hash::make($validatedData['password'])
        ]);

        return redirect()->route('user.index')->with('success', 'Usuário adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     * @access public
     * @param string $id
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        return view('user.edit');
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param ProfileRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $user = User::findOrFail(unserialize($id));

        $user->update([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf']
        ]);

        return redirect()->route('user.edit', ['user' => serialize(auth()->user()->id)])
            ->with('success', 'Usuário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $idUser = unserialize($id);

        if ($idUser != auth()->id()) {
            $user = User::findOrFail($idUser);
            $user->delete();
    
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        }

        return redirect()->route('user.index')->with([
            'success' => 'Não é possível excluir este usuário.', 'alert' => 'alert-warning'
        ]);
    }

    /**
     * Change the password
     * @access public
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::findOrFail(auth()->user()->id);

        $user->update(['password' => Hash::make($validatedData['password'])]);

        return redirect()->route('user.edit', ['user' => serialize(auth()->user()->id)])
            ->with('password_status', 'Senha atualizada com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return ['Usuário', 'E-mail', 'CPF', 'Excluir'];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $users
     * @return array $arrayData
     */
    private function getArrayData($users)
    {
        $arrayData = [];
        foreach ($users as $user) {
            $arrayData[] = [
                'user' => $user['name'] . ' ' . $user['last_name'],
                'email' => $user['email'],
                'cpf' => $this->formatCpf($user['cpf']),
                'delete' => $this->getIconDelete(
                    $user['id'],
                    'delete_user',
                    'user',
                    'Excluir Usuário',
                    'Você realmente deseja excluir este usuário?'
                )
            ];
        }

        return $arrayData;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Loan;
use App\Models\Member;
use App\Models\MemberType;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $members = (new Member())->lstMember();

        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($members);

        $arrayMemberType = MemberType::query()->pluck('id')->toArray();

        $userData = User::query()->select('user.email', 'user.cpf')->get()->toArray();

        $arrayEmail = array_merge(array_column($members, 'email'), array_column($userData, 'email'));
        $arrayPhone = array_column($members, 'phone');
        $arrayCpf = array_merge(array_column($members, 'cpf'), array_column($userData, 'cpf'));
    
        return view('member.index')->with([
            'arrayHeader' => $arrayHeader,
            'arrayData' => $arrayData,
            'arrayMemberType' => $arrayMemberType,
            'arrayEmail' => $arrayEmail,
            'arrayPhone' => $arrayPhone,
            'arrayCpf' => $arrayCpf
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $slMemberType = array_column((new MemberType())->lstMemberType(), 'type', 'id');

        return view('member.create')->with('slMemberType', $slMemberType);
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param MemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MemberRequest $request)
    {
        $validatedData = $request->validated();

        Member::create([
            'full_name' => $validatedData['full_name'],
            'id_member_type' => $validatedData['id_member_type'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'cpf' => $validatedData['cpf'],
            'id_user' => auth()->user()->id
        ]);

        return redirect()->route('member.index')->with('success', 'Membro adicionado com sucesso!');
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
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail(unserialize($id))->toArray();
        $slMemberType = array_column((new MemberType())->lstMemberType(), 'type', 'id');

        return view('member.edit')->with(['member' => $member, 'slMemberType' => $slMemberType]);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param MemberRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MemberRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $member = Member::findOrFail(unserialize($id));

        $member->update([
            'full_name' => $validatedData['full_name'],
            'id_member_type' => $validatedData['id_member_type'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'cpf' => $validatedData['cpf'],
            'id_user' => auth()->user()->id
        ]);

        return redirect()->route('member.index')->with('success', 'Membro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $idMember = unserialize($id);

        if (empty((new Loan())->lstLoan(idMember: $idMember))) {
            Loan::where('id_member', $idMember)->delete();
            
            $member = Member::findOrFail($idMember);
            $member->delete();
    
            return redirect()->route('member.index')->with('success', 'Membro excluído com sucesso!');
        }

        return redirect()->route('member.index')->with([
            'success' => 'Não foi possível excluir, o membro está com um livro emprestado.',
            'alert' => 'alert-warning'
        ]);
    }

    /**
     * Import the specified resource from storage.
     * @access public
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $file = $request->file('csv-file');
        
        $lines = file($file->getPathname());
        array_shift($lines);

        $lineRemove = json_decode($request->input('invalid-rows'));
        $filteredLines = $this->arrayFilter($lines, $lineRemove);

        foreach ($filteredLines as $line) {
            $columns = explode(';', $line);
            $columns[4] = str_replace("\r\n", '', $columns[4]);

            Member::create([
                'full_name' => $columns[0],
                'id_member_type' => $columns[1],
                'email' => empty($columns[2]) ? null : $columns[2],
                'phone' => empty($columns[3]) ? null : $columns[3],
                'cpf' => empty($columns[4]) ? null : $columns[4],
                'id_user' => auth()->user()->id
            ]);
        }
        
        return redirect()->route('member.index')->with('success', 'Membros importados com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return ['Nome', 'Tipo', 'E-mail', 'Telefone', 'CPF', 'Editar', 'Excluir'];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $members
     * @return array $arrayData
     */
    private function getArrayData($members)
    {
        $arrayData = [];
        foreach ($members as $member) {
            $arrayData[] = [
                'full_name' => $member['full_name'],
                'type' => $member['type'],
                'email' => $member['email'],
                'phone' => $member['phone'],
                'cpf' => !is_null($member['cpf']) ? $this->formatCpf($member['cpf']) : '',
                'edit' => $this->getIconEdit(serialize($member['id']), 'member', 'Editar Membro'),
                'delete' => $this->getIconDelete(
                    $member['id'],
                    'delete_member',
                    'member',
                    'Excluir Membro',
                    'Você realmente deseja excluir este membro?'
                )
            ];
        }

        return $arrayData;
    }
}

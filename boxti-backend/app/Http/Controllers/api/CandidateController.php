<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateStack;
use App\Models\Stack;
use Carbon\Carbon;
use Exception;

class CandidateController extends Controller
{
    public function index()
    {
        return Candidate::with('stacks')->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['date_birth'] = Carbon::createFromFormat('d/m/Y', $data['date_birth'])->format('Y-m-d');
        $cpf = $data['cpf'];

        try {
            if ($candidate = Candidate::where('cpf', $cpf)->withTrashed()->first()) {
                throw new Exception('Você já cadastrou um currículo!');
            }
            Candidate::create($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getmessage()], 400);
        }

        foreach ($data as $key => $value) {
            if ($key == 'stacks') {
                foreach ($value as $stack){
                    $stackID = Stack::where('name', $stack)->first()->id;
                    $candidateID = Candidate::where('cpf', $cpf)->first()->id;
                    CandidateStack::create(['candidate_id' => $candidateID, 'stack_id' => $stackID]);
                }
            }
        }
    }

    public function show($id)
    {
        return Candidate::with('stacks')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::with('stacks')->findOrFail($id);
        $data = $request->all();
        $data['date_birth'] = Carbon::createFromFormat('d/m/Y', $data['date_birth'])->format('Y-m-d');
        $cpf = $data['cpf'];

        $candidateArray =  $candidate->toArray();

        foreach ($candidateArray['stacks'] as $stack) {
            $found_key = array_search($stack['name'], array_column($data['stacks'], 'name'));
            if(!$found_key) {
                $candidateStack =  CandidateStack::where('candidate_id', $candidate['id'])->where('stack_id', $stack['id'])->first();
                $candidateStack->delete();
            }
        }

        foreach ($data as $key => $value) {
            if ($key == 'stacks') {
                foreach ($value as $stack){
                    $stackID = Stack::where('name', $stack)->first()->id;
                    $candidateID = Candidate::where('cpf', $cpf)->first()->id;
                    if (!CandidateStack::where('candidate_id', $candidateID)->where('stack_id', $stackID)->first()) {
                        CandidateStack::create(['candidate_id' => $candidateID, 'stack_id' => $stackID]);
                    }
                }
            }
        }

        $candidate->update($data);
    }

    public function destroy($id)
    {
        $candidate = Candidate::with('stacks')->findOrFail($id);
        $candidate->delete();
    }

    public function search(Request $request) 
    {
        $data = $request->all();
        $candidatesEnabled = [];
        foreach ($data as $stackName) {
            $stackID = Stack::where('name', $stackName)->first()->id;
            $candidatesHaveStack = CandidateStack::where('stack_id', $stackID)->get();
            foreach ($candidatesHaveStack->toArray() as $key) {
                $candidateID = $key['candidate_id'];
                $arraySearch = array_search($candidateID, $candidatesEnabled);
                if (!is_integer($arraySearch)) {
                    array_push($candidatesEnabled, $candidateID);
                }
            }
        }

        $candidates = Candidate::with('stacks')->whereIn('id', $candidatesEnabled)->get();
        return $candidates;
    }
}

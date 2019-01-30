<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Checklists;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->type = 'checklists';
    }

    public function showAll()
    {
        $checklists = Checklists::all();

        if ($checklists) {
            return response()->json([
                'success' => true,
                'message' => 'Data found!',
                'data' => $checklists
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found!',
                'data' => ''
            ], 404);
        }
    }

    public function show($id)
    {
        $checklists = Checklists::find($id);

        if ($checklists) {
            return response()->json([
                'success' => true,
                'message' => 'Data found!',
                'data' => $checklists
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found!',
                'data' => ''
            ], 404);
        }
    }

    public function create(Request $request)
    {
        
        $allData = $request->input('data');
        $allData = $allData['attributes'];
        
        $allData = [
            'object_domain' => $allData['object_domain'],
            'object_id' => $allData['object_id'],
            'due' => $allData['due'],
            'urgency' => $allData['urgency'],
            'description' => $allData['description']
        ];

        $input = Checklists::create($allData);

        if ($input) {
            return response()->json([
                'type' => $this->type,
                'id' => $input->id,
                'attributes' => $input,
                'links' => [
                    'self' => ''
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Failed!',
                'data' => ''
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->input('data');
        $checklists = Checklists::find($id)->first();
        $checklists->object_domain = $input['attributes']['object_domain'];
        $checklists->object_id = $input['attributes']['object_id'];
        $checklists->description = $input['attributes']['description'];
        $checklists->is_completed = $input['attributes']['is_completed'];
        $checklists->completed_at = $input['attributes']['completed_at'];

        $proses = $checklists->save();

        if ($proses) {
            return response()->json([
                'type' => $this->type,
                'id' => $checklists->id,
                'attributes' => $input['attributes'],
                'links' => [
                    'self' => ''
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Update Failed!',
                'data' => ''
            ], 400);
        }
    }

    public function delete($id)
    {
        $checklists = Checklists::find($id);

        $proses = $checklists->delete();

        if ($proses) {
            return response()->json([
                'success' => true,
                'message' => 'Data Deleted!'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Deleted!'
            ], 400);
        }
    }

}

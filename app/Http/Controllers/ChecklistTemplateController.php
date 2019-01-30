<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChecklistTemplate;

class ChecklistTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll()
    {
        $checklists = ChecklistTemplate::all();

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
        $checklists = ChecklistTemplate::find($id);

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
        $input = ChecklistTemplate::create($allData);

        if ($input) {
            return response()->json([
                'id' => $input->id,
                'attributes' => $input
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
        $checklists = ChecklistTemplate::find($id)->first();
        $checklists->name = $input['name'];
        $checklists->checklist = $input['checklist'];
        $checklists->items = $input['items'];

        $proses = $checklists->save();

        if ($proses) {
            return response()->json([
                'id' => $checklists->id,
                'attributes' => $input
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
        $checklists = ChecklistTemplate::find($id);

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

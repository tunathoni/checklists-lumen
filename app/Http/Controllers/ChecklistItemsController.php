<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChecklistItem;

class ChecklistItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll($checklistId)
    {
        $checklists = ChecklistItem::where('checklist_id', $checklistId)->get();

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

    public function show($checklistId, $itemId)
    {
        $checklists = ChecklistItem::where('checklist_id', $checklistId)
                        ->where('id', $itemId)
                        ->get();

        if (count($checklists) > 0) {
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

    public function create(Request $request, $checklistId)
    {
        
        $allData = $request->input('data');
        $allData = $allData['attribute'];
        $allData['checklist_id'] = $checklistId;
        $input = ChecklistItem::create($allData);

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

    public function update(Request $request, $checklistId, $itemId)
    {
        $input = $request->input('data');
        $input = $input['attribute'];
        $checklists = ChecklistItem::where('checklist_id', $checklistId)
                        ->where('id', $itemId)
                        ->first();
        $checklists->description = $input['description'];
        $checklists->due = $input['due'];
        $checklists->urgency = $input['urgency'];

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

    public function complete(Request $request)
    {
        $arrData = $request->input('data');
        $output  = [];
        
        foreach ($arrData as $key => $value) {
            $checklists = ChecklistItem::find($value['item_id']);
            $checklists->is_completed = true;
            $checklists->save();
            array_push($output, [
                "id" => $checklists->id,
                "item_id" => $checklists->id,
                "is_completed" => true,
                "checklist_id" => $checklists->checklist_id
            ]);
        }
        return response()->json([
            'data' => $output
        ], 400);
    }
    
    public function incomplete(Request $request)
    {
        $arrData = $request->input('data');
        $output  = [];
        
        foreach ($arrData as $key => $value) {
            $checklists = ChecklistItem::find($value['item_id']);
            $checklists->is_completed = false;
            $checklists->save();
            array_push($output, [
                "id" => $checklists->id,
                "item_id" => $checklists->id,
                "is_completed" => false,
                "checklist_id" => $checklists->checklist_id
            ]);
        }
        return response()->json([
            'data' => $output
        ], 400);
    }

    public function delete($checklistId, $itemId)
    {
        $checklists = ChecklistItem::where('checklist_id', $checklistId)
                        ->where('id', $itemId)
                        ->first();

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

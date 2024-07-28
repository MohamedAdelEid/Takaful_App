<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $notes = Note::with('user')->get();
            if ($notes->isEmpty()) {
                return $this->errorResponse('No notes found', 404);
            }
            return $this->successResponse($notes, 'Notes reterived successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:15',
                'side' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
                if($validatedData->fails()){
                    return $this->errorResponse(['message' => $validatedData->errors()], 422);
                }
            $note = Note::create($validatedData);          
            return $this->successResponse($note, 'Note created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        try {
            $note = Note::findOrFail($id);
            if ($note->user_id !== Auth::id()) {
                return $this->errorResponse('You are not authorized to delete this note', 403);
            }
            $note->delete();
            return $this->successResponse(null, 'Note deleted successfully', 200);
        }catch (ModelNotFoundException $e) {
            return $this->errorResponse(['message' => 'Note Not found'], 500);
        }
         catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
    }
}

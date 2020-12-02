<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Request;
use App\Models\{Note, Subject};

class NoteController extends Controller
{

	public function index()
	{
		$notes = Note::with('subject')->latest()->get();
		return NoteResource::collection($notes);
	}

	public function show(Note $note)
	{
		return NoteResource::make($note);
	}

	public function store()
	{
		request()->validate([
			'title' => 'required',
			'subject' => 'required',
			'description' => 'required'
		]);

		$subject = Subject::findOrFail(request('subject'));
		$note = Note::create([
			'subject_id' => $subject->id,
			'title' => request('title'),
			'slug' => \Str::slug(request('title')),
			'description' => request('description')
		]);

		return response()->json([
			'message' => 'Note berhasil disimpan',
			'note' => $note
		]);
	}

	public function update(Note $note)
	{
		request()->validate([
			'title' => 'required',
			'subject' => 'required',
			'description' => 'required'
		]);

		$subject = Subject::findOrFail(request('subject'));
		$note->update([
			'subject_id' => $subject->id,
			'title' => request('title'),
			'slug' => \Str::slug(request('title')),
			'description' => request('description')
		]);

		return response()->json([
			'message' => 'Note berhasil diubah',
			'note' => $note
		]);
	}

	public function destroy(Note $note)
	{
		$note->delete();

		return response()->json([
			'message' => 'Note berhasil dihapus',
			'note' => $note
		], 200);
	}
}

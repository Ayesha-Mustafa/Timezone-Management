<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Auth;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $records = Record::where('user_id', $user->id)->get();
        // Convert timestamps to user's timezone
        $records->transform(function($record) use ($user) {
            $record->created_at = Carbon::parse($record->created_at)->timezone($user->timezone);
            return $record;
        });

        return view('records.index', compact('records'));
    }

    public function create()
    {
        return view('records.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string',
        ]);

        $record = new Record();
        $record->user_id = $user->id;
        $record->task_name = $request->task_name;
        $record->task_description = $request->task_description;
        $record->created_at = Carbon::now('UTC'); // Store in UTC
        $record->save();

        return redirect()->route('records.index')->with('success', 'Record added successfully.');
    }
}

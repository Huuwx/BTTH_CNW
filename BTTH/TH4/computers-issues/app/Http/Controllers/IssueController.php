<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::with('computer')->paginate(10);
        return view('issues.index', compact('issues'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('issues.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            // Validate máy tính
            'computer_name' => 'required',
            'model' => 'required',
            'operating_system' => 'required',
            'processor' => 'required',
            'memory' => 'required|integer',
            'available' => 'nullable|boolean',

            // Validate vấn đề
            'reported_by' => 'required',
            'reported_date' => 'required|date',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
            'description' => 'required',
        ]);

        // Tạo máy tính
        $computer = Computer::create([
            'computer_name' => $request->computer_name,
            'model' => $request->model,
            'operating_system' => $request->operating_system,
            'processor' => $request->processor,
            'memory' => $request->memory,
            'available' => $request->available ?? false,
        ]);

        // Tạo vấn đề và liên kết với máy tính
        Issue::create([
            'computer_id' => $computer->id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'urgency' => $request->urgency,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        // Redirect sau khi lưu
        return redirect()->route('issues.index')->with('success', 'Task và máy tính được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            // Validate thông tin máy tính
            'computer_name' => 'required',
            'model' => 'required',
            'operating_system' => 'required',
            'processor' => 'required',
            'memory' => 'required|integer',
            'available' => 'nullable|boolean',

            // Validate thông tin vấn đề
            'reported_by' => 'required',
            'reported_date' => 'required|date',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
            'description' => 'required',
        ]);

        // Cập nhật thông tin máy tính
        $issue->computer->update([
            'computer_name' => $request->computer_name,
            'model' => $request->model,
            'operating_system' => $request->operating_system,
            'processor' => $request->processor,
            'memory' => $request->memory,
            'available' => $request->available ?? false,
        ]);

        // Cập nhật thông tin vấn đề
        $issue->update([
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'urgency' => $request->urgency,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        // Redirect sau khi cập nhật
        return redirect()->route('issues.index')->with('success', 'Task được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $computer = $issue->computer; // Lấy máy tính liên quan
        $issue->delete();

        $computer->delete();

        return redirect()->route('issues.index')->with('success', 'Task deleted successfully.');
    }
}

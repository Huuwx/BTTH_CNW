@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Sửa Vấn Đề</h1>
    <form action="{{ route('issues.update', $issue->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h3>Thông tin máy tính</h3>
        <div class="form-group">
            <label for="computer_name">Tên máy tính:</label>
            <input type="text" class="form-control" id="computer_name" name="computer_name" 
                   value="{{ $issue->computer->computer_name }}" required>
        </div>
        <div class="form-group">
            <label for="model">Phiên bản:</label>
            <input type="text" class="form-control" id="model" name="model" 
                   value="{{ $issue->computer->model }}" required>
        </div>
        <div class="form-group">
            <label for="operating_system">Hệ điều hành:</label>
            <input type="text" class="form-control" id="operating_system" name="operating_system" 
                   value="{{ $issue->computer->operating_system }}" required>
        </div>
        <div class="form-group">
            <label for="processor">Bộ xử lý:</label>
            <input type="text" class="form-control" id="processor" name="processor" 
                   value="{{ $issue->computer->processor }}" required>
        </div>
        <div class="form-group">
            <label for="memory">Bộ nhớ RAM (GB):</label>
            <input type="number" class="form-control" id="memory" name="memory" 
                   value="{{ $issue->computer->memory }}" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="available" name="available" 
                   {{ $issue->computer->available ? 'checked' : '' }} value="1">
            <label class="form-check-label" for="available">Đang hoạt động</label>
        </div>

        <h3>Thông tin vấn đề</h3>
        <div class="form-group">
            <label for="reported_by">Người báo cáo sự cố:</label>
            <input type="text" class="form-control" id="reported_by" name="reported_by" 
                   value="{{ $issue->reported_by }}" required>
        </div>
        <div class="form-group">
            <label for="reported_date">Ngày báo cáo:</label>
            <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" 
                   value="{{ $issue->reported_date }}" required>
        </div>
        <div class="form-group">
            <label for="urgency">Mức độ sự cố:</label>
            <select class="form-control" id="urgency" name="urgency" required>
                <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Mô tả sự cố:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $issue->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection

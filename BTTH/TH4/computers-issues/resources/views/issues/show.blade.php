@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Chi tiết Vấn đề</h1>

    <h3>Thông tin Máy tính</h3>
    <p><strong>Tên máy tính:</strong> {{ $issue->computer->computer_name }}</p>
    <p><strong>Tên Phiên Bản:</strong> {{ $issue->computer->model }}</p>
    <p><strong>Hệ điều hành:</strong> {{ $issue->computer->operating_system }}</p>
    <p><strong>Bộ vi xử lý:</strong> {{ $issue->computer->processor }}</p>
    <p><strong>Bộ nhớ RAM:</strong> {{ $issue->computer->memory }} GB</p>
    <p><strong>Trạng Thái Hoạt Động:</strong> {{ $issue->computer->available ? 'Còn Hoạt Động' : 'Không Còn Hoạt Động' }}</p>

    <hr>

    <h3>Thông tin Vấn đề</h3>
    <p><strong>Người báo cáo:</strong> {{ $issue->reported_by }}</p>
    <p><strong>Thời gian báo cáo:</strong> {{ $issue->reported_date }}</p>
    <p><strong>Mức độ sự cố:</strong> {{ $issue->urgency }}</p>
    <p><strong>Trạng thái:</strong> {{ $issue->status }}</p>
    <p><strong>Mô tả sự cố:</strong> {{ $issue->description }}</p>

    <hr>

    <a href="{{ route('issues.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection

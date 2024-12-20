@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Danh sách Vấn Đề</h1>
    <a href="{{ route('issues.create') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>Mã Vấn Đề</th>
                <th>Tên máy tính</th>
                <th>Tên phiên bản</th>
                <th>Người báo cáo sự cố</th>
                <th>Thời gian báo cáo</th>
                <th>Mức độ sự cố</th>
                <th>Trạng thái hiện tại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->computer->computer_name ?? 'N/A' }}</td>
                    <td>{{ $issue->computer->model ?? 'N/A' }}</td>
                    <td>{{ $issue->reported_by }}</td>
                    <td>{{ $issue->reported_date }}</td>
                    <td>{{ $issue->urgency }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>
                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="clearfix">
        <ul class="pagination justify-content-center" style="margin-top: 20px;">
            @if ($issues->onFirstPage())
                <li class="page-item disabled"><a href="#">Trước</a></li>
            @else
                <li class="page-item"><a href="{{ $issues->previousPageUrl() }}" class="page-link">Trước</a></li>
            @endif

            @for ($i = 1; $i <= $issues->lastPage(); $i++)
                @if ($i == $issues->currentPage())
                    <li class="page-item active"><a href="#" class="page-link">{{ $i }}</a></li>
                @else
                    <li class="page-item"><a href="{{ $issues->url($i) }}" class="page-link">{{ $i }}</a></li>
                @endif
            @endfor

            @if ($issues->hasMorePages())
                <li class="page-item"><a href="{{ $issues->nextPageUrl() }}" class="page-link">Tiếp</a></li>
            @else
                <li class="page-item disabled"><a href="#">Tiếp</a></li>
            @endif
        </ul>
    </div>
</div>
@endsection
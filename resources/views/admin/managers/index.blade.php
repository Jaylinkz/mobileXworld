@extends('admin.admin')

@section('title', 'Manager List')
@section('content-header', 'Manager List')
@section('content-actions')
    <a href="{{url('Manager/create')}}" class="btn btn-primary">Add Manager</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    {{-- <th>ID</th>
                    <th>Avatar</th> --}}
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    {{-- <th>Phone</th>
                    <th>Address</th> --}}
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($managers as $manager)
                    <tr>
                        <td>{{$manager->id}}</td>
                        {{-- <td>
                            <img width="50" src="{{$manager->getAvatarUrl()}}" alt="">
                        </td> --}}
                        <td>{{$manager->first_name}}</td>
                        <td>{{$manager->last_name}}</td>
                        <td>{{$manager->email}}</td>
                        {{-- <td>{{$manager->phone}}</td>
                        <td>{{$manager->address}}</td> --}}
                        <td>{{$manager->created_at}}</td>
                        <td>
                            <a href="{{ route('Manager.edit', $manager->id) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('Manager.destroy', $manager->id)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $managers->render() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this customer?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection

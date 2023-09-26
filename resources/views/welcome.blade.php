<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controller Service Testing</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Create Todo</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('todo.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control" id="title"
                                    aria-describedby="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30"
                                    rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Todo Management</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $key => $todo)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <th>{{ $todo->title }}</th>
                                    <td>{{ $todo->description }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                        <button data_id="{{ $todo->id }}"
                                            class="delete-btn btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        $(document).ready(function () {

            // Todo Delete
            $('.delete-btn').click(function () {
                let todoId = this.getAttribute('data_id');
                let url = "{{ route('todo.destroy',':id') }}";
                url = url.replace(':id', todoId);
                let method = "DELETE";
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let row = this.parentElement.parentElement;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        itemDelete(url, method, token, row)
                    }
                })
            })


            // Feature Delete Function
            function itemDelete(url, method, token, row, data = {}) {
                fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: method,
                        credentials: "same-origin",
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            Swal.fire(
                                'Success',
                                data.message,
                                'success'
                            );
                            if (row) {
                                row.remove();
                            }
                        } else {
                            console.log(data);
                            Swal.fire(
                                'Failed',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        Swal.fire(
                            'Failed',
                            error.message,
                            'error'
                        );
                    });
            }
        })

    </script>
</body>

</html>

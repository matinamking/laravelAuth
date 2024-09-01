<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">مدیریت کاربران</h2>

        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addUserModal">کاربر جدید</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>عملیات</th>
                    <th>ایمیل</th>
                    <th>نام</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach ($users as $value)
                    <tr>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editUserModal{{ $value->id }}">ویرایش</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteUserModal{{ $value->id }}">حذف</button>
                        </td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->name }}</td>
                    </tr>


                    <div class="modal fade" id="editUserModal{{ $value->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">ویرایش کاربر</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.update', $value->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        @csrf
                                        <div class="form-group">
                                            <label for="editUserName">نام</label>
                                            <input type="text" class="form-control" id="editUserName"
                                                value="{{ $value->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editUserEmail">ایمیل</label>
                                            <input type="email" class="form-control" id="editUserEmail"
                                                value="{{ $value->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editPassUserName">پسورد</label>
                                            <input type="password" class="form-control" id="editPassUserName" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteUserModal{{ $value->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel">حذف کاربر</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.destroy', $value->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <div class="form-group">
                                            <label for="deleteUserName">نام کاربر</label>
                                            <input type="text" value="{{ $value->name }}" class="form-control"
                                                id="deleteUserName" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="deleteUserEmail">ایمیل کاربر</label>
                                            <input type="text" value="{{ $value->email }}" class="form-control"
                                                id="deleteUserEmail" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">کاربر جدید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="addUserForm">
                        @csrf
                        <div class="form-group">
                            <label for="addUserName">نام</label>
                            <input type="text" class="form-control" id="addUserName" required>
                        </div>
                        <div class="form-group">
                            <label for="addUserEmail">ایمیل</label>
                            <input type="email" class="form-control" id="addUserEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="addUserPassword">پسورد</label>
                            <input type="password" class="form-control" id="addUserPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function reloadPages() {
            $(document).ready(function() {
                location.reload();
            });
        }

        $('#addUserForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/admin',
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#addUserModal').modal('hide');
                    reloadPages();
                }
            });
        });

        $('#editUserForm').submit(function(event) {
            event.preventDefault();
            const id = $('#editUserId').val();
            const name = $('#editUserName').val();
            const email = $('#editUserEmail').val();

            $.ajax({
                url: `/api/users/${id}`,
                method: 'PUT',
                data: {
                    name: name,
                    email: email
                },
                success: function() {
                    $('#editUserModal').modal('hide');
                }
            });
        });
    </script>

</body>

</html>

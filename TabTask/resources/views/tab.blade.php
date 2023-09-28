<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        li a:hover:not(.active) {
            background-color: #3890ce;
            color: white;
        }

        li {
            width: 200px;
        }
    </style>
</head>

<body>
    @php
    $teacherArray = $teacher;
    $classArray = $class;
    $cnt_student=1;
    $cnt_class=1;
    $cnt_teacher=1;
    @endphp
    <div class="container">
        <h2>Dynamic Tabs</h2>
        <div id="tab_div text-center">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#student">Student</a></li>
                <li><a href="#class">Class</a></li>
                <li><a href="#teacher">Teacher</a></li>
            </ul>
        </div>

        <div class="tab-content">
            <div id="student" class="tab-pane fade in active">
                <div id="student_form">
                    <h3>Student</h3>
                    <form id="studentForm" data-form-type="student">
                        {{ csrf_field() }}
                        <input type="hidden" name="active_tab" value="student">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sname">Name:</label>
                                    <input type="text" class="form-control" id="sname" placeholder="Enter name" name="sname">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="semail">Email:</label>
                                    <input type="text" class="form-control" id="semail" placeholder="Enter email" name="semail">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="saddress">Address:</label>
                                    <input type="address" class="form-control" id="saddress" placeholder="Enter class" name="saddress">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sclass">Class:</label>
                                    <select class="form-control" name="sclass">
                                        <option value="">Select Class</option>
                                        @foreach ($classArray as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="steacher">Teacher:</label>
                                    <select class="form-control" name="steacher">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teacherArray as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="scast">Cast:</label><br>
                                    <input type="checkbox" name="scast[]" value="OBC"> OBC
                                    <input type="checkbox" name="scast[]" value="EBC"> EBC
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-lg btn-info align-center" onclick="submitForm('studentForm')">Add Student</button>
                        </div>
                    </form>
                </div>
                <br><br>

                <!-- student edit  -->

                <div id="edit_student_form" style="display: none;">
                    <h3>Edit Student</h3>
                    <form id="studentEditForm" data-form-type="student">
                        {{ csrf_field() }}
                        <input type="hidden" name="active_tab" value="student">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sname">Name:</label>
                                    <input type="text" class="form-control" id="edit_sname" placeholder="Enter name" name="sname">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="semail">Email:</label>
                                    <input type="text" class="form-control" id="edit_semail" placeholder="Enter email" name="semail">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="saddress">Address:</label>
                                    <input type="address" class="form-control" id="edit_saddress" placeholder="Enter class" name="saddress">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sclass">Class:</label>
                                    <select class="form-control" name="sclass">
                                        <option value="">Select Class</option>
                                        @foreach ($classArray as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="steacher">Teacher:</label>
                                    <select class="form-control" name="steacher">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teacherArray as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="scast">Cast:</label><br>
                                    <input type="checkbox" name="scast[]" value="OBC"> OBC
                                    <input type="checkbox" name="scast[]" value="EBC"> EBC
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="updateRecord('studentEditForm')">Update</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit('studentEditForm')">Cancel</button>
                    </form>
                </div>
                <!-- end student edit  -->

                <table id="studentTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Student Name</th>
                            <th> Email</th>
                            <th> Address</th>
                            <th> Class</th>
                            <th>Teacher</th>
                            <th>Cast</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student as $student)
                        <tr data-id="{{ $student->id }}">
                            <td>{{ $cnt_student++ }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->address }}</td>
                            <td>
                                @if ($student->class_relation)
                                {{ $student->class_relation->class_name }}
                                @else
                                Relationship Not Loaded
                                @endif
                            </td>
                            <td>
                                @if ($student->teacher_relation)
                                {{ $student->teacher_relation->name }}
                                @else
                                Relationship Not Loaded
                                @endif
                            </td>
                            <td>{{ $student->cast }}</td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="editRecord('student', '{{ $student->id }}')">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteRecord('student','{{ $student->id }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="class" class="tab-pane fade">
                <div id="class_form">
                    <h3>Class</h3>
                    <form id="classForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="active_tab" value="class">
                        <div class="row mb-3">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="cclass">Class:</label>
                                    <input type="text" class="form-control" id="cclass" placeholder="Enter class" name="cclass">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <button type="button" class="btn btn-lg btn-info align-center" onclick="submitForm('classForm')">Add Class</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><br><br>
                <!-- class edit  -->
                <div id="edit_class_form" style="display: none;">
                    <h3>Edit Class</h3>
                    <form id="editClassForm" data-form-type="class">
                        {{ csrf_field() }}
                        <input type="hidden" name="edit_active_tab" value="class">
                        <div class="row mb-3">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="cclass">Class:</label>
                                    <input type="text" class="form-control" id="edit_class" placeholder="Enter class" name="cclass" value="">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="updateRecord('editClassForm')">Update</button>
                    </form>
                </div>
                <!-- end class edit  -->
                <table id="classTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classArray as $class)
                        <tr data-id="{{ $class->id }}">
                            <td>{{ $cnt_class++ }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="editRecord('class', '{{ $class->id }}')">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteRecord('class','{{ $class->id }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="teacher" class="tab-pane fade">
                <div id="teacher_form">
                    <h3>Teacher</h3>
                    <form id="teacherForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="active_tab" value="teacher">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tname">Name:</label>
                                    <input type="text" class="form-control" id="tname" placeholder="Enter name" name="tname">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tgender">Genter:</label><br>
                                    Male: <input class="form-check-input" type="radio" value="Male" name="gender" id="male">
                                    Female: <input class="form-check-input" type="radio" value="Female" name="gender" id="female">
                                </div>
                            </div>
                        </div><br>
                        <div class="text-center">
                            <button type="button" class="btn btn-lg btn-info align-center" onclick="submitForm('teacherForm')">Add Teacher</button>
                        </div>
                    </form>
                </div>
                <br><br>

                <!-- teacher edit  -->
                <div id="edit_teacher_form" style="display: none;">
                    <h3>Edit Teacher</h3>
                    <form id="editTeacherForm" data-form-type="teacher">
                        {{ csrf_field() }}
                        <input type="hidden" name="edit_active_tab" value="class">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tname">Name:</label>
                                    <input type="text" class="form-control" id="edit_tname" placeholder="Enter name" name="tname">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="tgender">Genter:</label><br>
                                    Male: <input class="form-check-input" type="radio" value="Male" name="gender" id="edit_male">
                                    Female: <input class="form-check-input" type="radio" value="Female" name="gender" id="edit_female">
                                </div>
                            </div>
                        </div><br>
                        <button type="button" class="btn btn-success" onclick="updateRecord('editTeacherForm')">Update</button>
                    </form>
                </div>
                <!-- end teacher edit  -->

                <table id="teacherTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teacherArray as $teacher)
                        <tr data-id="{{ $teacher->id }}">
                            <td>{{ $cnt_teacher++ }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="editRecord('teacher', '{{ $teacher->id }}')">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteRecord('teacher','{{ $teacher->id }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".nav-tabs a").click(function() {
                $(this).tab('show');

            });
        });

        // Function to submit the form via AJAX
        function submitForm(formId) {
            var formData = $('#' + formId).serialize();
            $.ajax({
                type: "POST",
                url: "/store-data",
                data: formData,
                success: function(response) {
                    $('#' + formId)[0].reset();

                    switch (response.active_tab) {
                        case 'student':
                            appendToStudentTable(response.data);
                            break;
                        case 'class':
                            appendToClassTable(response.data);
                            break;
                        case 'teacher':
                            appendToTeacherTable(response.data);
                            break;
                    }

                },
            });
        }

        function appendToStudentTable(data) {
            var cnt_student = $("#studentTable tbody tr").length;
            cnt_student++;
            var newRow = '<tr data-id="' + data.id + '">' +
                '<td>' + cnt_student + '</td>' +
                '<td>' + data.name + '</td>' +
                '<td>' + data.email + '</td>' +
                '<td>' + data.address + '</td>' +
                '<td>' + data.class_name + '</td>' +
                '<td>' + data.teacher_name + '</td>' +
                '<td>' + data.cast + '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-info">Edit</button>' +
                '<button type="button" class="btn btn-danger" onclick="deleteRecord(\'student\',' + data.id + ')">Delete</button>' +
                '</td>' +
                '</tr>';

            $('#studentTable tbody').append(newRow);
        }


        function appendToClassTable(data) {
            var cnt_class = $("#classTable tbody tr").length;
            cnt_class++;

            var newRow = '<tr data-id="' + data.id + '">' +
                '<td>' + cnt_class + '</td>' +
                '<td>' + data.class_name + '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-info">Edit</button>' +
                '<button type="button" class="btn btn-danger" onclick="deleteRecord(\'class\',' + data.id + ')">Delete</button>' +
                '</td>' +
                '</tr>';

            $('#classTable tbody').append(newRow);
        }

        function appendToTeacherTable(data) {
            var cnt_teacher = $("#classTable tbody tr").length;
            cnt_teacher++;

            var newRow = '<tr data-id="' + data.id + '">' +
                '<td>' + cnt_teacher + '</td>' +
                '<td>' + data.name + '</td>' +
                '<td>' + data.gender + '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-info">Edit</button>' +
                '<button type="button" class="btn btn-danger" onclick="deleteRecord(\'teacher\', ' + data.id + ')">Delete</button>' +
                '</td>' +
                '</tr>';

            $('#teacherTable tbody').append(newRow);
        }


        function deleteRecord(type, id) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: "DELETE",
                    url: '/delete_record/' + id,
                    data: {
                        form_type: type,
                        _token: $('input[name="_token"]').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            switch (type) {
                                case 'student':
                                    $('#studentTable tbody tr[data-id="' + id + '"]').remove();
                                    break;
                                case 'class':
                                    $('#classTable tbody tr[data-id="' + id + '"]').remove();
                                    break;
                                case 'teacher':
                                    $('#teacherTable tbody tr[data-id="' + id + '"]').remove();
                                    break;
                            }
                        } else {
                            alert('Failed to delete record');
                        }
                    },
                });
            }
        }

        function editRecord(type, id) {
            $.ajax({
                type: "GET",
                url: '/get_record/' + type + '/' + id,
                success: function(response) {
                    if (response.success) {
                        switch (type) {
                            case 'student':
                                populateStudentEditForm(response.data);
                                break;
                            case 'class':
                                populateClassEditForm(response.data);
                                break;
                            case 'teacher':
                                populateTeacherEditForm(response.data);
                                break;
                        }
                    } else {
                        alert('Failed to fetch record for editing');
                    }
                },
            });
        }

        function populateStudentEditForm(data) {
            $('#edit_student_form input[name="sname"]').val(data.name);
            $('#edit_student_form input[name="semail"]').val(data.email);
            $('#edit_student_form input[name="saddress"]').val(data.address);
            $('#edit_student_form input[name="sclass"]').val(data.class);
            $('#edit_student_form input[name="steacher"]').val(data.teacher);
            classArray=data.class;
            
            $('#edit_student_form').show();
            $('#edit_class_form').hide();
            $('#edit_teacher_form').hide();
            $('#student_form').hide();

        }

        function populateClassEditForm(data) {
            $('#edit_class_form input[name="cclass"]').val(data.class_name);

            $('#edit_student_form').hide();
            $('#edit_class_form').show();
            $('#edit_teacher_form').hide();
            $('#class_form').hide();

        }

        function populateTeacherEditForm(data) {
            $('#edit_teacher_form input[name="tname"]').val(data.name);
            $('#edit_teacher_form input[type="radio"][name="gender"][value="' + data.gender + '"]').prop('checked', true);

            $('#edit_student_form').hide();
            $('#edit_class_form').hide();
            $('#edit_teacher_form').show();
            $('#teacher_form').hide();

        }
    </script>
</body>

</html>
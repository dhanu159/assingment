<div class="container">
    <div class="row">
        <div class="search col-md-4">
            <label>Search</label>
            <input type="text" id="searchBy">
        </div>
        <div class="col-md-4">
            <select name="" id="book_category">
            </select>
        </div>
        <div class="add_book col-md-4">
            <a style="float:right" class="btn btn-info" href="<?php echo base_url('Dashboard/viewAddNewBook') ?>">Add New book</a>
        </div>
    </div>
    <div>

    </div>

    <?php
    if (isset($result)) { ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $result; ?></div>
    <?php } ?>


    <table class="table table-striped" id="bookDetailsTable" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="showData">
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BOOK DETAILS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="bookId" class="form-control" name="bookId1">
                    <div class="form-group col-md-6">
                        <label for="">Book Title:</label>
                        <input type="text" class="form-control" name="book_title" id="book_title1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Year of Publishing :</label>
                        <input type="text" class="form-control" name="year_of_publishing" id="year_of_publishing1">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Price :</label>
                        <input type="text" class="form-control" name="price" id="price1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">ISBN :</label>
                        <input type="text" class="form-control" name="isbn" id="isbn1">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Medium :</label>
                        <input type="text" class="form-control" name="author" id="medium1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Author :</label>
                        <input type="text" class="form-control" name="author" id="author1">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="book_category">Category :</label>
                        <input type="text" class="form-control" name="author" id="book_category1">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="book_category">Book Image :</label>
                        <img src="" alt="" id="book_image1">
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {

                loadBookCategories();
                loadBookDetails();

            });

            $('#book_category').change(
                function() {
                    var book_category = $("#book_category").children("option:selected").text();
                    $.ajax({
                        type: 'ajax',
                        method: 'post',
                        url: baseUrl + 'Dashboard/searchBookAccordingToCategory',
                        data: {
                            'book_category': book_category
                        },
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data != '') {
                                var html = '';
                                var i;
                                for (i = 0; i < data.length; i++) {
                                    var image = "";
                                    if (data[i].image) {
                                        image = baseUrl + "uploads/" + data[i].image;
                                    } else {
                                        image = baseUrl + "resources/img/defaultBook.jpg";
                                    }
                                    var selectToUpdateBookDetailsURL = baseUrl + "Dashboard/selectToUpdateBookDetails/" + data[i].bookId;
                                    html += '<tr>' +
                                        '<td >' + data[i].name + '</td>' +

                                        '<td >' + data[i].author_name + '</td>' +
                                        '<td >' + data[i].price + '</td>' +
                                        '<td > <img src = ' + image + ' style="width:80px;" ></td>' +

                                        '<td><a href="#exampleModal" data="' + data[i].bookId + '" data-toggle="modal" class="btn btn-success code-dialog item-view">View More</a></td>' +
                                        '<td><a class="btn btn-info" href="' + selectToUpdateBookDetailsURL + '">Update</a>' +
                                        '&nbsp;&nbsp;&nbsp;&nbsp;' +
                                        '<a href="javascript:;" data-toggle="tooltip" title="Delete Record" class="item-delete btn btn-danger" data="' + data[i].bookId + '">Delete</a></td>' +
                                        '</tr>';
                                }
                                $('#showData').html(html);
                            } else {
                                alert('Failed to load book details');
                            }
                        },
                        error: function() {
                            alert('Could not load data');
                        }

                    });

                });

            function loadBookCategories() {
                $.ajax({
                    type: 'ajax',
                    url: baseUrl + 'Dashboard/loadBookCategories',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var categories = '';
                        for (i = 0; data.length > i; i++) {
                            categories += '<option value="' + data[i].id + '">' + data[i].category_name + '</option>';
                        }
                        $('#book_category').html(categories);
                        $("#book_category").prop('selectedIndex', -1);

                    },
                    error: function() {
                        alert('internal error could not load book categories!')
                    }
                });
            }

            $('#bookDetailsTable').on('click', '.item-view', function() {
                $("#exampleModal").show();
                var bookId = $(this).attr('data');
                var bookId =
                    $.ajax({
                        type: 'ajax',
                        method: 'post',
                        url: baseUrl + 'Dashboard/LoadSelectedBook',
                        data: {
                            'bookId': bookId
                        },
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data != '') {
                                for (i = 0; i < data.length; i++) {
                                    $('#book_title1').val(data[i].name);
                                    $('#author1').val(data[i].author_name);
                                    $('#price1').val(data[i].price);
                                    $('#bookId1').val(data[i].bookId);
                                    $('#medium1').val(data[i].medium);
                                    $('#year_of_publishing1').val(data[i].year_of_publishing);
                                    $('#isbn1').val(data[i].isbn);
                                    $('#book_category1').val(data[i].category_name);

                                    $('#book_image1').attr("src", baseUrl + "uploads/" + data[i].image);

                                }
                                console.log(data);
                            } else {
                                alert('Failed to load book details');
                            }
                        },
                        error: function() {
                            alert('Could not load data');
                        }

                    });
            });

            function loadBookDetails() {
                $.ajax({
                    type: 'ajax',
                    url: baseUrl + 'Dashboard/loadBookDetails',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data != '') {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                var image = "";
                                if (data[i].image) {
                                    image = baseUrl + "uploads/" + data[i].image;
                                } else {
                                    image = baseUrl + "resources/img/defaultBook.jpg";
                                }
                                var selectToUpdateBookDetailsURL = baseUrl + "Dashboard/selectToUpdateBookDetails/" + data[i].bookId;
                                html += '<tr>' +
                                    '<td >' + data[i].name + '</td>' +

                                    '<td >' + data[i].author_name + '</td>' +
                                    '<td >' + data[i].price + '</td>' +
                                    '<td > <img src = ' + image + ' style="width:80px;" ></td>' +
                                    '<td><a href="#exampleModal" data="' + data[i].bookId + '" data-toggle="modal" class="btn btn-success code-dialog item-view">View More</a></td>' +
                                    '<td><a class="btn btn-info" href="' + selectToUpdateBookDetailsURL + '">Update</a>' +
                                    '&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<a href="javascript:;" data-toggle="tooltip" title="Delete Record" class="item-delete btn btn-danger" data="' + data[i].bookId + '">Delete</a></td>' +
                                    '</tr>';
                            }
                            $('#showData').html(html);
                        } else {
                            alert('Failed to load book details');
                        }
                    },
                    error: function() {
                        alert('Could not load data');
                    }
                });
            }

            $("#searchBy").keypress(function() {
                var searchBy = $("#searchBy").val()
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: baseUrl + 'Dashboard/searchBookDetails',
                    data: {
                        'searchBy': searchBy
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data != '') {
                            var html = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                var image = "";
                                if (data[i].image) {
                                    image = baseUrl + "uploads/" + data[i].image;
                                } else {
                                    image = baseUrl + "resources/img/defaultBook.jpg";
                                }
                                var selectToUpdateBookDetailsURL = baseUrl + "Dashboard/selectToUpdateBookDetails/" + data[i].bookId;
                                html += '<tr>' +
                                    '<td >' + data[i].name + '</td>' +

                                    '<td >' + data[i].author_name + '</td>' +
                                    '<td >' + data[i].price + '</td>' +
                                    '<td > <img src = ' + image + ' style="width:80px;" ></td>' +

                                    '<td><a href="#exampleModal" data="' + data[i].bookId + '" data-toggle="modal" class="btn btn-success code-dialog item-view">View More</a></td>' +
                                    '<td><a class="btn btn-info" href="' + selectToUpdateBookDetailsURL + '">Update</a>' +
                                    '&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<a href="javascript:;" data-toggle="tooltip" title="Delete Record" class="item-delete btn btn-danger" data="' + data[i].bookId + '">Delete</a></td>' +
                                    '</tr>';
                            }
                            $('#showData').html(html);
                        } else {
                            alert('Failed to load book details');
                        }
                    },
                    error: function() {
                        alert('Could not load data');
                    }

                });
            });

            $('#bookDetailsTable').on('click', '.item-delete', function() {
                var bookId = $(this).attr('data');
                swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            $.ajax({
                                type: 'ajax',
                                url: baseUrl + 'Dashboard/deleteBookDetails',
                                async: false,
                                dataType: 'json',
                                method: 'post',
                                data: {
                                    'bookId': bookId
                                },
                                success: function(data) {
                                    if (data.status) {
                                        swal({
                                            title: 'Deleted!',
                                            text: data.msg,
                                            icon: "success",
                                            button: "OK!",
                                        });
                                        loadBookDetails();
                                    } else {
                                        swal({
                                            title: 'Failed to Delete Record!',
                                            text: data.msg,
                                            icon: "'error'",
                                            button: "OK!",
                                        });
                                    }

                                },
                                error: function() {
                                    alert('Could not process request');
                                }
                            });
                        } else {
                            swal("Your file is safe!");
                        }
                    });
            });

            $("#exampleModal").on('shown', function() {
                alert("I want this to appear after the modal has opened!");
            });
        </script>
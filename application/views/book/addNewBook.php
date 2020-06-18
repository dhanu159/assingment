<div class="container">
    <div class="text-center">
        <h1>Add New Book</h1>
    </div>
    <!-- validation errors -->
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger">
            <strong>Alert!</strong> <?php echo validation_errors(); ?>
        </div>
    <?php } ?>

    <!-- form errors -->
    <?php if (isset($error))
        echo $error;
    ?>


    <?php echo form_open_multipart(base_url('Dashboard/addNewBook')) ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Book Title:</label>
            <input type="text" class="form-control" name="book_title">
        </div>
        <div class="form-group col-md-6">
            <label for="">Year of Publishing :</label>
            <input type="text" class="form-control" name="year_of_publishing">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Price :</label>
            <input type="text" class="form-control" name="price">
        </div>
        <div class="form-group col-md-6">
            <label for="">ISBN :</label>
            <input type="text" class="form-control" name="isbn">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Medium :</label>
            <select class="form-control" id="medium" name="medium">
                <option>Sinhala</option>
                <option>Tamil</option>
                <option>English</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="">Author :</label>
            <input type="text" class="form-control" name="author">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="book_category">Category :</label>
            <select class="form-control" id="book_category" name="book_category">
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="book_category">Book Image :</label>
            <input type="file" class="form-control" name="book_image" size="20" />
        </div>
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            loadBookCategories();
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
                },
                error: function() {
                    alert('internal error could not load book categories!')
                }
            });
        }
    </script>